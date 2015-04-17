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
use yii\web\Session;

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
			$objModelContato = new ContactForm();

			return $this->render('index', [
				'contato' => $objModelContato,
				'cadastro' => $objModelCliente,
				'login' => $objModelLogin,
			]);
			
			
		} catch (\Exception $objExcessao) {

			Yii::$app->session->setFlash('error', $objExcessao->getMessage()); 
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
