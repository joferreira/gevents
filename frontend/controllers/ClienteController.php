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
	public function actionCadastro() {

		/*
		try {

			$objModelCliente = new Cliente(['scenario' => 'register']);
			$objModelLog = new Log();

			if (isset($_POST['Cliente'])) {
				$arrDados = $_POST['Cliente'];

				if ($arrDados['STR_SENHA'] == $arrDados['STR_SENHA_CONFIRME']) {

					$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);
					if (empty($arrStatusEmail)) {
						// Salva o organizador
						$intIdCliente = $objModelCliente->saveOrganizador($arrDados);

						// Salva o Log de Cadastro
						$arrLog = array();
						$arrLog['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
						$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_CADASTRO;
						$objModelLog->saveLog($arrLog);

						// Envia o Email de confirmação 
						$arrDados['STR_TIPO_ENVIO'] = 'confirmacao';
						EmailHelper::SendEmail($arrDados);

						Yii::$app->session->setFlash('cadastrado', 'Agradecemos por se cadastrar no Gigantes dos Eventos. Para acessar seu Dashboard insira seu e-mail e senha.');
						return $this->redirect(['site/index', '#' => 'login']);
					} else
						Yii::$app->session->setFlash('error', 'Seu e-mail já cadastrado, por favor, pedimos para que verifique e requisite lembrar de sua senha. Obrigado!');
				} else
					Yii::$app->session->setFlash('error', 'Sua senha, está diferente da requisitada. Por favor, pedimos que verifique');
			} else
				Yii::$app->session->setFlash('error', '"Os campos não estão preenchidos corretamente, por favor, verifique!');

			return $this->redirect(['site/index', '#' => 'register']);
			
		} catch (\Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage());
			return $this->redirect(['site/index', '#' => 'register']);
		} */

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

					//Yii::$app->session->setFlash('cadastrado', 'Agradecemos por se cadastrar no Gigantes dos Eventos. Para acessar seu Dashboard insira seu e-mail e senha.');
				} else
					$arrResponse['message'] = ['Seu e-mail já cadastrado, por favor, pedimos para que verifique e requisite lembrar de sua senha. Obrigado!'];
					//Yii::$app->session->setFlash('error', 'Seu e-mail já cadastrado, por favor, pedimos para que verifique e requisite lembrar de sua senha. Obrigado!');

				//Yii::$app->session->setFlash('error', '"Os campos não estão preenchidos corretamente, por favor, verifique!');
				
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

			if (isset($_POST['Cliente'])) {
				$arrDados = $_POST['Cliente'];

				$arrStatusEmail = $objModelCliente->verificaEmailSenha($arrDados);
				if (empty($arrStatusEmail)) 
					Yii::$app->session->setFlash('error_login', 'E-mail e/ou senha estão incorretos. Por favor, verifique!');
				else 
					Yii::$app->session->setFlash('cadastrado', 'Login efetuado com sucesso!');

			} else
				Yii::$app->session->setFlash('error_login', '"Os campos não estão preenchidos corretamente, por favor, verifique!');

			return $this->redirect(['site/index', '#' => 'login']);
			/*
			return $this->render('/site/success', [
				'model' => $objModelCliente,
			]); */
			
		} catch (\Exception $objException) {
			Yii::$app->session->setFlash('error_login', $objException->getMessage());
			return $this->redirect(['site/index', '#' => 'login']);
		}

	}

}
