<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use common\models\Evento;
use common\models\Status;
use common\models\TipoEvento;
use common\models\Log;
use common\models\Staff;
use common\models\Ingresso;
//use common\models\VoucherPromocional;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\EmailHelper;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\Response;
use yii\web\Controller;
use yii\web\Session;

class IngressoController extends Controller
{
	public function actionIndex()
	{
		try {
			$objModelIngresso = new Evento();
			
			$arrStaffEvento['CLIENTE_INT_ID_CLIENTE'] = Yii::$app->session->get('INT_ID_CLIENTE');
			$arrIngressos = 0; //$objModelIngresso->consultar($arrStaffEvento);
			
			return $this->render('grid_ingresso', ['arrIngressos' => $arrIngressos]);
		} catch (\Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}

	}

	// Formulário para criação e alteraçao do evento
	public function actionFormulario()
	{
		try { // ['scenario' => 'criacao']
			$objModelEvento = new Evento();
			$objModelIngresso = new Ingresso();
			//$objModelVoucherPromocional = new VoucherPromocional();
			$objModelLog = new Log();
			$objModelStaff = new Staff();

			$objEvento = $objModelEvento->find()->all();
			$arrEvento = ArrayHelper::map($objEvento,'INT_ID_EVENTO','STR_NOME');

			for ($hr=0; $hr < 24 ; $hr++) { 
				$hora = (strlen($hr) == 1) ? '0'.$hr : $hr;
				$arrHora[$hora] = $hora; 
			}
			
			for ($mn=0; $mn < 12 ; $mn++) {
				$min = $mn * 5;
				$minuto = (strlen($min) == 1) ? '0'.$min : $min;
				$arrMinuto[$minuto] = $minuto;
			}

			// Post de dados do formulário
			if ( isset($_POST['Ingresso']) ) {
				
				$arrIngresso = $_POST['Ingresso'];
				//$mapsGoogle = $_POST['MapsGoogle'];
				$intIdCliente = Yii::$app->session->get('INT_ID_CLIENTE');

				if ( $objModelIngresso->load(Yii::$app->request->post()) ) {
					
					//$arrEvento['STATUS_INT_ID_STATUS'] = Status::STATUS_AGUARDANDO ;
					$arrResultIngresso = $objModelIngresso->saveIngresso($arrIngresso);

					//$arrEnderecoEvento['EVENTO_INT_ID_EVENTO'] = $arrResultIngresso['INT_ID_EVENTO'];
					//$arrResultEnderecoEvento = $objModelEnderecoEvento->saveEnderecoEvento($arrEnderecoEvento);
					/*
					if ( !empty($mapsGoogle['INT_ID_MAPS_GOOGLE']) ){
						if( $mapsGoogle['INT_ID_MAPS_GOOGLE'] == 'S' ){
							$arrMapsGoogle['ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'] = $arrResultEnderecoEvento['INT_ID_ENDERECO_EVENTO'];
							$arrResultMapsGoogle = $objModelMapsGoogle->insertMapsGoogle($arrMapsGoogle);
						} else {
							$objMapsGoogle = $objModelMapsGoogle->findOne(array('ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'=>$arrResultEnderecoEvento['INT_ID_ENDERECO_EVENTO']))->delete();
						}
					}*/

					// Gravação de log
					$arrLog = array();
					if( empty($arrEvento['INT_ID_EVENTO']) ){
						$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_INGRESSO_CADASTRADO;
						/*
						$arrStaff['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
						$arrStaff['EVENTO_INT_ID_EVENTO'] = $arrResultEvento['INT_ID_EVENTO'];
						$arrStaff['STR_GERENTE'] = 'OW';

						$objModelStaff->saveStaffEvento($arrStaff);

						// Envia o Email de Criação 
						$arrEvento['STR_TIPO_ENVIO'] = 'criacao';
						$arrEvento['STR_EMAIL'] = Yii::$app->session->get('STR_EMAIL');
						$arrEvento['STR_NOME_COMPLETO'] = Yii::$app->session->get('STR_NOME');
						EmailHelper::SendEmail($arrEvento);
						*/

					} else {
						$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_INGRESSO_ALTERADO;
					}

					$arrLog['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
					$arrLog['EVENTO_INT_ID_EVENTO'] = $arrIngresso['INT_ID_EVENTO'];

					$objModelLog->saveLog($arrLog);

					return $this->redirect(['/dashboard/ingresso']);

				}
			
			}
		
			return $this->render('formulario', [
				'objModelIngresso' => $objModelIngresso,
				//'objModelEnderecoEvento' => $objModelEnderecoEvento,
				'arrHora' => $arrHora,
				'arrMinuto' => $arrMinuto,
				'arrEvento' => $arrEvento,
			]);

		} catch (Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
	}

	// Busca o Evento para editar
	public function actionEditar($id)
	{
		try {
			$objModelEvento =  new Evento(['scenario' => 'criacao']);
			$objModelEnderecoEvento = new EnderecoEvento();
			$objModelTipoEvento = new TipoEvento();
			$objModelUnidadeFederal = new UnidadeFederal();
			$objModelMapsGoogle = new MapsGoogle();
			$objModelLog = new Log();
			$objModelStaff = new Staff();

			$objTipoEvento = $objModelTipoEvento->find()->all();
			$arrTipoEvento = ArrayHelper::map($objTipoEvento,'INT_ID_TIPO_EVENTO','STR_DESCRICAO');

			$objUnidadeFederal = $objModelUnidadeFederal->find()->all();
			$arrUnidadeFederal = ArrayHelper::map($objUnidadeFederal,'INT_ID_UNIDADE_FEDERAL','STR_DESCRICAO_UNIDADE_FEDERAL');

			for ($hr=0; $hr < 24 ; $hr++) { 
				$hora = (strlen($hr) == 1) ? '0'.$hr : $hr;
				$arrHora[$hora] = $hora; 
			}
			
			for ($mn=0; $mn < 12 ; $mn++) {
				$min = $mn * 5;
				$minuto = (strlen($min) == 1) ? '0'.$min : $min;
				$arrMinuto[$minuto] = $minuto;
			}

			$objEvento = $objModelEvento->findOne($id);
			$objEnderecoEvento = $objModelEnderecoEvento->findOne(array('EVENTO_INT_ID_EVENTO'=>$objEvento->INT_ID_EVENTO));
			$objMapsGoogle = $objModelMapsGoogle->findOne(array('ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'=>$objEnderecoEvento->INT_ID_ENDERECO_EVENTO));

			if(empty($objMapsGoogle))
				$objMapsGoogle = $objModelMapsGoogle;
		
			return $this->render('formulario', [
				'objModelEvento' => $objEvento,
				'objModelEnderecoEvento' => $objEnderecoEvento,
				'arrUnidadeFederal' => $arrUnidadeFederal,
				'arrTipoEvento' => $arrTipoEvento,
				'arrHora' => $arrHora,
				'arrMinuto' => $arrMinuto,
				'objModelMapsGoogle' => $objMapsGoogle,
			]);
		
		} catch (\Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
	}

	
}
