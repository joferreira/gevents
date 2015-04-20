<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use common\models\Evento;
use common\models\EnderecoEvento;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\EmailHelper;
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
			//$objModelLog = new Log();
			
			// Post de dados do formulário
			if ( isset($_POST['Evento']) ) {
				$objModelEvento->attributes = $_POST['Evento'];
				
				if ( $objModelEvento->load(Yii::$app->request->post()) ) {

				}
			}
		
			return $this->render('formulario', ['objModelEvento' => $objModelEvento, 'objModelEnderecoEvento' => $objModelEnderecoEvento]);
		} catch (Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
    }

}
