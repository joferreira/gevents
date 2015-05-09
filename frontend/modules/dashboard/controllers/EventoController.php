<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use common\models\Evento;
use common\models\EnderecoEvento;
use common\models\Status;
use common\models\TipoEvento;
use common\models\UnidadeFederal;
use common\models\Log;
use common\models\Staff;
use common\models\MapsGoogle;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\EmailHelper;
use yii\helpers\ArrayHelper;
use yii\web\Request;
use yii\web\Response;
use yii\web\Controller;
use yii\web\Session;

class EventoController extends Controller
{
	public function actionIndex()
	{
		try {
			$objModelEvento = new Evento();
			
			$arrStaffEvento['CLIENTE_INT_ID_CLIENTE'] = Yii::$app->session->get('INT_ID_CLIENTE');
			$arrEventos = $objModelEvento->consultar($arrStaffEvento);
			
			return $this->render('grid_evento', ['arrEventos' => $arrEventos]);
		} catch (\Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}

	}

	// Formulário para criação e alteraçao do evento
	public function actionFormulario()
	{
		try {
			$objModelEvento = new Evento(['scenario' => 'criacao']);
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

			// Post de dados do formulário
			if ( isset($_POST['Evento']) ) {
				
				$arrEvento = $_POST['Evento'];
				$arrEnderecoEvento = $_POST['EnderecoEvento'];
				$mapsGoogle = $_POST['MapsGoogle'];
				$intIdCliente = Yii::$app->session->get('INT_ID_CLIENTE');

				if ( $objModelEvento->load(Yii::$app->request->post()) ) {
					
					$arrEvento['STATUS_INT_ID_STATUS'] = Status::STATUS_AGUARDANDO ;
					$arrResultEvento = $objModelEvento->saveEvento($arrEvento);

					$arrEnderecoEvento['EVENTO_INT_ID_EVENTO'] = $arrResultEvento['INT_ID_EVENTO'];
					$arrResultEnderecoEvento = $objModelEnderecoEvento->saveEnderecoEvento($arrEnderecoEvento);

					if ( !empty($mapsGoogle['INT_ID_MAPS_GOOGLE']) ){
						if( $mapsGoogle['INT_ID_MAPS_GOOGLE'] == 'S' ){
							$arrMapsGoogle['ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'] = $arrResultEnderecoEvento['INT_ID_ENDERECO_EVENTO'];
							$arrResultMapsGoogle = $objModelMapsGoogle->insertMapsGoogle($arrMapsGoogle);
						} else {
							$objMapsGoogle = $objModelMapsGoogle->findOne(array('ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'=>$arrResultEnderecoEvento['INT_ID_ENDERECO_EVENTO']))->delete();
						}
					}

					// Gravação de log
					$arrLog = array();
					if( empty($arrEvento['INT_ID_EVENTO']) ){
						$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_EVENTO_CADASTRADO;
						$arrStaff['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
						$arrStaff['EVENTO_INT_ID_EVENTO'] = $arrResultEvento['INT_ID_EVENTO'];
						$arrStaff['STR_GERENTE'] = 'OW';

						$objModelStaff->saveStaffEvento($arrStaff);

						// Envia o Email de Criação 
						$arrEvento['STR_TIPO_ENVIO'] = 'criacao';
						$arrEvento['STR_EMAIL'] = Yii::$app->session->get('STR_EMAIL');
						$arrEvento['STR_NOME_COMPLETO'] = Yii::$app->session->get('STR_NOME');
						EmailHelper::SendEmail($arrEvento);

					} else {
						$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_EVENTO_ALTERADO;
					}

					$arrLog['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
					$arrLog['EVENTO_INT_ID_EVENTO'] = $arrResultEvento['INT_ID_EVENTO'];
					//$arrLog['HOTEVENT_INT_ID_HOTEVENT'] = $intIdHotevent;

					$objModelLog->saveLog($arrLog);

					return $this->redirect(['/dashboard/evento']);

				}
			
			}
		
			return $this->render('formulario', [
				'objModelEvento' => $objModelEvento,
				'objModelEnderecoEvento' => $objModelEnderecoEvento,
				'arrUnidadeFederal' => $arrUnidadeFederal,
				'arrTipoEvento' => $arrTipoEvento,
				'arrHora' => $arrHora,
				'arrMinuto' => $arrMinuto,
				'objModelMapsGoogle' => $objModelMapsGoogle,
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

	public function actionPublicar()
	{
		try{

			$objModelEvento =  new Evento();
			$objModelHotEvent = new Hotevent();
			$objModelLog = new Log();
			$objModelStaff = new Staff();

			if ( isset($_POST['Evento']) ) {
				
				$arrEvento =  $_POST['Evento'];
				$intIdCliente = Yii::$app->session->get('INT_ID_CLIENTE');
				
				if ( $objModelEvento->load(Yii::$app->request->post()) ) {

					$arrResultPublicar = $objModelEvento->saveEvento(['INT_ID_EVENTO'=> $idEvento, 'STATUS_INT_ID_STATUS'=>Status::STATUS_PUBLICADO]);

					$arrHotEvent['EVENTO_INT_ID_EVENTO'] = $arrResultPublicar['INT_ID_EVENTO'];
					$arrHotEvent['STR_CODIGO'] = $arrResultPublicar['INT_ID_EVENTO'];
					$arrHotEvent['STR_PATH_BANNER'] = $arrResultPublicar['INT_ID_EVENTO'];

					$arrResultHotEvent = $objModelHotEvent->saveHotEvent($arrHotEvent);

					// Gravação de log
					$arrLog = array();
					$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_EVENTO_PUBLICADO;
					$arrLog['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
					$arrLog['EVENTO_INT_ID_EVENTO'] = $arrResultEvento['INT_ID_EVENTO'];
					$arrLog['HOTEVENT_INT_ID_HOTEVENT'] = $arrResultHotEvent['INT_ID_HOTEVENT'];

					$objModelLog->saveLog($arrLog);
					
					// Envia o Email de Publicação 
					$arrEvento['STR_TIPO_ENVIO'] = 'publicacao';
					$arrEvento['STR_EMAIL'] = Yii::$app->session->get('STR_EMAIL');
					$arrEvento['STR_NOME_COMPLETO'] = Yii::$app->session->get('STR_NOME');
					EmailHelper::SendEmail($arrEvento);

				}
			}

		} catch (\Exception $objException){
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
/*
		Yii::$app->response->format = Response::FORMAT_JSON;
		$arrResponse = array('message' => '', 'response' => false );

		$objModelCliente = new Cliente(['scenario' => 'registerAjax']);
		$objModelLog = new Log();

		try {
			$arrDados = Yii::$app->request->post();

			$objModelCliente->attributes = $arrDados['Cliente'];

			if ($objModelCliente->validate()) {	

				$arrCliente = $arrDados['Cliente'];

				$arrStatusEmail = $objModelCliente->verificaEmail($arrCliente['STR_EMAIL']);
				if (empty($arrStatusEmail)) {
					// Salva o organizador
					$intIdCliente = $objModelCliente->saveOrganizador($arrCliente);

					// Salva o Log de Cadastro
					$arrLog = array();
					$arrLog['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
					$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_CADASTRO;
					$objModelLog->saveLog($arrLog);

					// Envia o Email de confirmação 
					$arrCliente['STR_TIPO_ENVIO'] = 'confirmacao';
					EmailHelper::SendEmail($arrCliente);

					$arrResponse['message'] = 'Agradecemos por se cadastrar no Gigantes dos Eventos. Para acessar seu Dashboard insira seu e-mail e senha.';
					$arrResponse['response'] = true;

				} else
					$arrResponse['message'] = ['Seu e-mail já cadastrado, por favor, pedimos para que verifique e requisite lembrar de sua senha. Obrigado!'];

				//Yii::$app->session->setFlash('error', 'Os campos não estão preenchidos corretamente, por favor, verifique!');
				
			} else 
				$arrResponse['message'] =$objModelCliente->errors;
		
			return $arrResponse;

		} catch (\Exception $objExcessao) {

			$arrResponse = [
				'message' => $objExcessao->getMessage(),
				'response' => false,
			];
			return $arrResponse;
		}

*/
	}
	
}
