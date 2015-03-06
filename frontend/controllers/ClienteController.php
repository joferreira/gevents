<?php

namespace frontend\controllers;

use Yii;
use common\models\Cliente;
use frontend\models\CadastroForm;
use yii\web\Controller;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Método de controle de cliente.
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
            $objModelCliente = new Cliente();

            if (isset($_POST['CadastroForm'])) {
                $arrCadastrado = $_POST['CadastroForm'];

                $arrDados = array();
                $arrDados['STR_NOME_COMPLETO'] = $cadastrado['nome'];
                $arrDados['STR_EMAIL'] = $cadastrado['email'];
                $arrDados['STR_SENHA'] = $cadastrado['senha'];

                if ($arrCadastrado['senha'] == $arrCadastrado['confirmeSenha']) {
                    $arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);
                    
                    if (empty($arrStatusEmail)) {
                        // Salva o organizador
                        $intIdCliente = $objModelCliente->saveOrganizador($arrDados);
                        //print_r($_POST['CadastroForm']);
                        echo "Seu cadastro efetuado com sucesso. Obrigado por fazer parte!";
                    } else
                        throw new Exception("Seu e-mail já cadastrado, por favor, pedimos para que verifique e requisite lembrar de sua senha. Obrigado!");
                } else
                    throw new Exception("Sua senha, está diferente da requisitada. Por favor, pedimos que verifique");
            } else
                throw new Exception("Os campos não estão preenchidos corretamente, por favor, verifique!");
        } catch (Exception $objException) {
            echo $objException->getMessage();
        }*/
        
        try {

			$objModelCliente = new Cliente();

			if( isset($_POST['CadastroForm']) ){
				$arrCadastrado = $_POST['CadastroForm'];

				$arrDados = array();
				$arrDados['STR_NOME_COMPLETO'] = $arrCadastrado['nome'];
				$arrDados['STR_EMAIL'] = $arrCadastrado['email'];
				$arrDados['STR_SENHA'] = $arrCadastrado['senha'];

				if($arrCadastrado['senha'] == $arrCadastrado['confirmeSenha'] ){

					$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);
					if(empty($arrStatusEmail)){
						// Salva o organizador
						$intIdCliente = $objModelCliente->saveOrganizador($arrDados);
						//print_r($_POST['CadastroForm']);
						Yii::$app->session->setFlash('cadastrado', 'Seu cadastro efetuado com sucesso. Obrigado por fazer parte!');
						return $this->redirect(['site/index', '#'=>'login']);

					} else 	Yii::$app->session->setFlash('error', 'Seu e-mail já cadastrado, por favor, pedimos para que verifique e requisite lembrar de sua senha. Obrigado!');
					
				} else Yii::$app->session->setFlash('error', 'Sua senha, está diferente da requisitada. Por favor, pedimos que verifique');

			} else 	Yii::$app->session->setFlash('error', '"Os campos não estão preenchidos corretamente, por favor, verifique!');

			return $this->redirect(['site/index', '#'=>'register']);
			
		} catch (Exception $objException) {
			Yii::$app->session->setFlash('error', $objException->getMessage() );
			return $this->redirect(['site/index', '#'=>'register']);
		}
    }

}
