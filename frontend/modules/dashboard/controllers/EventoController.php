<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use common\models\Evento;
use common\models\EnderecoEvento;
use common\models\Status;
use common\models\TipoEvento;
use common\models\UnidadeFederal;
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
		return $this->render('grid_evento');
	}

	public function actionFormulario()
	{
		try {
			$objModelEvento = new Evento();
			$objModelEnderecoEvento = new EnderecoEvento();
			$objModelTipoEvento = new TipoEvento();
			$objModelUnidadeFederal = new UnidadeFederal();
			//$objModelLog = new Log();

			$objTipoEvento = $objModelTipoEvento->find()->all();
			$arrTipoEvento = ArrayHelper::map($objTipoEvento,'INT_ID_TIPO_EVENTO','STR_DESCRICAO');

			$objUnidadeFederal = $objModelUnidadeFederal->find()->all();
			$arrUnidadeFederal = ArrayHelper::map($objUnidadeFederal,'INT_ID_UNIDADE_FEDERAL','STR_DESCRICAO_UNIDADE_FEDERAL');
			
			// Post de dados do formulário
			if ( isset($_POST['Evento']) ) {
				//$objModelEvento->attributes = $_POST['Evento'];
				
				if ( $objModelEvento->load(Yii::$app->request->post()) ) {
					$objModelEvento->saveEvento($_POST['Evento']);
				}
			}
		
			return $this->render('formulario', [
				'objModelEvento' => $objModelEvento,
				'objModelEnderecoEvento' => $objModelEnderecoEvento,
				'arrUnidadeFederal' => $arrUnidadeFederal,
				'arrTipoEvento' => $arrTipoEvento,
			]);

		} catch (Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
	}

}
