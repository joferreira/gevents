<?php
namespace frontend\controllers;

use Yii;
use common\models\Cliente;
use frontend\models\ContactForm;
use frontend\models\CadastroForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\Exception;

/**
 * Site controller
 */
class SiteController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{

		try {			

			$objModelCliente = new Cliente(['scenario' => 'register']);
			$objModelLogin = new Cliente(['scenario' => 'login']);
			$contato = new ContactForm();
			$cadastro = new Cliente(['scenario' => 'register']);

			/*if ($objModelCliente->load(Yii::$app->request->post()) ){

				if( isset($_POST['CadastroForm']) ){
					$arrDados = $_POST['CadastroForm'];

					if($arrDados['STR_SENHA'] == $arrDados['STR_SENHA_CONFIRME'] ){

						$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);

						if(empty($arrStatusEmail)){
							$intIdCliente = $objModelCliente->saveOrganizador($arrDados);					
							Yii::$app->session->setFlash('cadastrado', 'cadastro efetuado com sucesso!');
						} else Yii::$app->session->setFlash('error', 'E-mail já cadastrado!');

					} else {
						Yii::$app->session->setFlash('error', 'A confirma senha é diferente da senha'); 
						return $this->redirect(['#register']);
					}

				} // else Yii::$app->session->setFlash('error', 'Campos não preenchidos corretamente!'); 

			//} */

			return $this->render('index', [
				//'cliente' => $objModelCliente,
				'contato' => $contato,
				'cadastro' => $cadastro,
				'formCadastro' => $objModelCliente,
				'login' => $objModelLogin,
			]);
			
			
		} catch (Exception $e) {

			Yii::$app->session->setFlash('error', $e->getMessage()); //echo $e->getMessage();
		}
	}

	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionFaq()
	{
		return $this->render('faq');
	}

}
