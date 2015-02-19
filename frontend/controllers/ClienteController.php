<?php

namespace frontend\controllers;

use Yii;
use common\models\Cliente;
use frontend\models\CadastroForm;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class ClienteController extends \yii\web\Controller
{
	public function actionCadastro()
	{
		try {			

			$objModelCliente = new Cliente();

			if( isset($_POST['CadastroForm']) ){
				$cadastrado = $_POST['CadastroForm'];

				$arrDados = array();
				$arrDados['STATUS_INT_ID_STATUS'] = 2;
				$arrDados['STR_NOME_COMPLETO'] = $cadastrado['nome'];
				$arrDados['STR_EMAIL'] = $cadastrado['email'];
				$arrDados['STR_SENHA'] = $cadastrado['senha'];

				if($cadastrado['senha'] == $cadastrado['confirmeSenha'] ){

					$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);
					if(empty($arrStatusEmail)){
						$intIdCliente = $objModelCliente->saveCliente($arrDados);
						//print_r($_POST['CadastroForm']);

						echo "cadastro efetuado com sucesso!";

					} else 	throw new Exception("E-mail já cadastrado!");
					
				} else 	throw new Exception("A confirma senha é diferente da senha");

			} else 	throw new Exception("Campos não preenchidos corretamente!");				
			
		} catch (Exception $e) {

			echo $e->getMessage();
		}
		/*

		try {
			$objModelCliente = new CLIENTE();
			$objModelAceite = new ACEITE();
			$objModelAcesso = new ACESSO();
			$objModelLog = new LOG();

			// Validação Ajax
			$this->performAjaxValidation($objModelCliente);
			$this->performAjaxValidation($objModelAceite);

			// Post de dados do formulário
			if (isset($_POST['CLIENTE']) && isset($_POST['ACEITE'])) {
				$objModelCliente->attributes = $_POST['CLIENTE'];
				$objModelAceite->attributes = $_POST['ACEITE'];

				if ($objModelCliente->validate()) {
					$arrStatusEmail = $objModelCliente->verificaEmail($_POST['CLIENTE']['STR_EMAIL']);

					// Verifica se e-mail possui em base de dados e efetua tratamento
					if (!empty($arrStatusEmail)) {
						// Retorna para a view informando que existe e-mail cadastrado
						Yii::app()->user->setFlash('warning', 'Atenção! O e-mail informado já está cadastrado.');
					} else {
						// Verifica a validação do aceite e efetua a gravação dos dados
						if ($objModelAceite->validate()) {
							if (empty($_POST['ACEITE']['STR_ACEITE_TERMO']) || empty($_POST['ACEITE']['STR_ACEITE_ARTISTA'])) {
								// Retorna para a view requisitando o aceite dos termos
								Yii::app()->user->setFlash('warning', 'Atenção! O aceite dos termos, são necessários para sua inscrição.');
							} else {
								// Salva inscrição inicial de cliente e recebe o último código de cliente registrado
								$intMaxIdCliente = $objModelCliente->saveClienteInicial($_POST['CLIENTE']);

								$arrAceite = array();
								$arrAceite['CLIENTE_INT_ID_CLIENTE'] = $intMaxIdCliente;
								$arrAceite['STR_ACEITE_TERMO'] = $_POST['ACEITE']['STR_ACEITE_TERMO'];
								$arrAceite['STR_ACEITE_ARTISTA'] = $_POST['ACEITE']['STR_ACEITE_ARTISTA'];
								$arrAceite['STR_ACEITE_NEWSLETTER'] = $_POST['ACEITE']['STR_ACEITE_NEWSLETTER'];

								// Salva termos de aceite
								$objModelAceite->saveAceite($arrAceite);

								$arrAcesso = array();
								$arrAcesso['CLIENTE_INT_ID_CLIENTE'] = $intMaxIdCliente;

								$objModelAcesso->saveAcesso($arrAcesso);

								$arrLog = array();
								$arrLog['CLIENTE_INT_ID_CLIENTE'] = $intMaxIdCliente;
								$arrLog['STR_OCORRENCIA'] = LOG::MENSAGEM_CADASTRO;

								$objModelLog->saveLog($arrLog);

								// Envio de e-mail
								$_POST['CLIENTE']['STR_TIPO_ENVIO'] = 'confirmacao';
								Helpers::SendEmail($_POST['CLIENTE']);

								// Retorno de mensagem
								Yii::app()->user->setFlash('success', 'Inscrição feita com sucesso!<br>Agradecemos pela sua participação.');

								$this->redirect(array('cliente/inscricao'));
							}
						}
					}
				}
			}

			// Envio para a view
			$this->render('inscricao', array(
				'objModelCliente' => $objModelCliente,
				'objModelAceite' => $objModelAceite
			));
		} catch (Exception $objException) {
			echo 'Exception: ' . $objException->getMessage() . '<br>';
		}
		*/

	}

}
