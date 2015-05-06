<?php

namespace frontend\controllers;

use Yii;
use common\models\Cliente;
use common\models\TipoCliente;
use common\models\Log;
use frontend\models\CadastroForm;
use yii\web\Controller;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\EmailHelper;
use yii\web\Request;
use yii\web\Response;
use yii\web\Session;

/**
 * Método de controle de cliente.
 * 
 * @package Controller
 * @author Josemar Ferreira <jf.sorin@gmail.com>
 */

class ClienteController extends Controller {

	/**
	 * Método para cadastro do cliente.
	 * 
	 * @throws Exception
	 */
	public function actionCadastro()
	{

		Yii::$app->response->format = Response::FORMAT_JSON;
		$arrResponse = array('message' => '', 'response' => false );

		$objModelCliente = new Cliente(['scenario' => 'registerAjax']);
		$objModelLog = new Log();

		try {
			$arrDados = Yii::$app->request->post();

			$objModelCliente->attributes = $arrDados['Cliente'];

			if ($objModelCliente->validate()) {	
				//throw new \Exception("N!");

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

	}

	/**
	 * Método para o login do cliente.
	 * 
	 * @throws Exception
	 */
	public function actionLogin() {

		try {

			$objModelCliente = new Cliente(['scenario' => 'login']);
			$objSession = new Session();
			$objModelLog = new Log();

			if (isset($_POST['Cliente'])) {
				$arrDados = $_POST['Cliente'];

				$arrEmailSenha = $objModelCliente->verificaEmailSenha($arrDados);
				if (empty($arrEmailSenha)) 
					Yii::$app->session->setFlash('error_login', 'E-mail e/ou senha estão incorretos. Por favor, verifique!');
				else {

					$objSession->open();
					//$objSession->setName('PHPFRONTSESSID');
					$objSession->set( 'INT_ID_CLIENTE',$arrEmailSenha['INT_ID_CLIENTE'] );
					$objSession->set( 'STR_NOME',$arrEmailSenha['STR_NOME_COMPLETO'] );
					$objSession->set( 'STR_EMAIL', $arrEmailSenha['STR_EMAIL'] );
					$objSession->set( 'INT_TIPO_CLIENTE', $arrEmailSenha['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'] );
					$objSession->set( 'INT_STATUS', $arrEmailSenha['STATUS_INT_ID_STATUS'] );
					$objSession->set( 'GE_LOGADO', true );
					// Define o tempo de acesso
					$objSession->set('passwordResetTokenExpire', time() + Yii::$app->params['user.passwordResetTokenExpire']); // 30 minutos
					$objSession->close();

					// Gravação de log
					$arrLog = array();
					$arrLog['CLIENTE_INT_ID_CLIENTE'] = $arrEmailSenha['INT_ID_CLIENTE'];
					$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_LOGIN;

					$objModelLog->saveLog($arrLog);

					// Redireciona para a view principal DASHBOARD
					return $this->redirect(['dashboard/']);
				}

			} else
				Yii::$app->session->setFlash('error_login', '"Os campos não estão preenchidos corretamente, por favor, verifique!');

			return $this->redirect(['site/index', '#' => 'login']);
			
		} catch (\Exception $objException) {
			Yii::$app->session->setFlash('error_login', $objException->getMessage());
			return $this->redirect(['site/index', '#' => 'login']);
		}

	}

	/**
	 * Método para logout de cliente.
	 * 
	 * @return type
	 */
	public function actionLogout()
	{
		$objSession = new Session;

		$objSession->open();
		$objSession->removeAll();
		$objSession->close();

		return $this->goHome();
	}

}
/*
SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`gevents`.`log`, CONSTRAINT `fk_LOG_EVENTO` FOREIGN KEY (`EVENTO_INT_ID_EVENTO`) REFERENCES `evento` (`INT_ID_EVENTO`) ON DELETE NO ACTION ON UPDATE NO ACTION)\nThe SQL being executed was: INSERT INTO `log` (`CLIENTE_INT_ID_CLIENTE`, `STR_OCORRENCIA`, `EVENTO_INT_ID_EVENTO`, `HOTEVENT_INT_ID_HOTEVENT`) VALUES ('1', 'Cadastro efetuado', '0', '0'

*/