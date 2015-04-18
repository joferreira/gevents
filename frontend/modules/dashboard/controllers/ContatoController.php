<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\base\Exception;
use yii\base\InvalidParamException;
use app\models\Contato;
use common\models\Log;
use yii\helpers\EmailHelper;

/**
 * Método controlador de contato.
 * 
 * @package Controller
 * @author Tecnologia da Informação <digital@distribuicaodigital.com.br>
 */
class ContatoController extends Controller
{
	/**
	 * Método de listagem dos contatos.
	 * 
	 * @return array Dados para a view da grid de contato
	 */
    public function actionIndex()
    {
		try {
			$objModelContato = new Contato();
			
			$objModelContato->CLIENTE_INT_ID_CLIENTE = Yii::$app->session->get('INT_ID_CLIENTE');
			$arrContato = $objModelContato->consultar();
			
			return $this->render('grid_contato', ['arrContato' => $arrContato]);
		} catch (Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
    }
	
	public function actionFormulario()
	{
		try {
			$objModelContato = new Contato(['scenario' => 'contato']);
			$objModelLog = new Log();
			
			// Post de dados do formulário
			if ( isset($_POST['Contato']) ) {
				$objModelContato->attributes = $_POST['Contato'];
				
				if ( $objModelContato->load(Yii::$app->request->post()) ) {
					if ( empty($_POST['Contato']['STR_MENSAGEM']) ) {
						// Retorna para a view requisitando o a mensagem
						Yii::$app->session->setFlash('warning', 'Atenção! A mensagem é necessária para o envio.');
					} else {
						// Salva o contato
						$objModelContato->saveContato($_POST['Contato']);
						
						$arrLog = array();
						$arrLog['CLIENTE_INT_ID_CLIENTE'] = $_POST['Contato']['CLIENTE_INT_ID_CLIENTE'];
						$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_CONTATO;

						$objModelLog->saveLog($arrLog);

						// Envio de e-mail
						$_POST['Contato']['STR_TIPO_ENVIO'] = 'contato';
						$_POST['Contato']['STR_EMAIL'] =  Yii::$app->session->get('STR_EMAIL');
						$_POST['Contato']['STR_NOME_COMPLETO'] =  Yii::$app->session->get('STR_NOME_COMPLETO');
						
						EmailHelper::SendEmail($_POST['Contato']);
						
						// Retorno de mensagem
						Yii::$app->session->setFlash('success', 'Contato efetuado com sucesso!<br>Agradecemos pela sua participação.');
						
						// Redireciona para a view de contato
						return $this->redirect(['contato/index']);
					}
				}
			}
		
			return $this->render('formulario', ['objModelContato' => $objModelContato]);
		} catch (Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
		}
	}

}
