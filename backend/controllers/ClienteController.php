<?php

namespace backend\controllers;

use Yii;
use common\models\Cliente;
use common\models\Endereco;
use backend\models\OrganizadorSearch;
use backend\models\ParticipanteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;

class ClienteController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}
	public function actions()
	{
	    return [
	        'error' => [
	            'class' => 'yii\web\ErrorAction',
	        ]
	    ];
	}
	/**
	 * Lista todos Organizadores.
	 * @return mixed
	 */
	public function actionOrganizador()
	{
		$searchModel = new OrganizadorSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('/cadastro/organizador', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Lista todos Participantes.
	 * @return mixed
	 */
	public function actionParticipante()
	{
		$searchModel = new ParticipanteSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('/cadastro/participante', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}	

	/**
	 * Lists all Usuario models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new UsarioSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Usuario model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('/cadastro/view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new Usuario model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{

		try {			

			$objModelCliente = new Cliente();
			$objModelEndereco = new Endereco();

			if ($objModelCliente->load(Yii::$app->request->post()) ){

				if( isset($_POST['Cliente']) ){
					$arrDados = $_POST['Cliente'];

					$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);
					if(empty($arrDados['STR_EMAIL']) ) {
						Yii::$app->session->setFlash('error', 'E-mail não foi preenchido!');
					} else if(empty($arrStatusEmail)){
						$intIdCliente = $objModelCliente->saveCliente($arrDados);
						Yii::$app->session->setFlash('success', 'cadastro efetuado com sucesso!'); // echo "cadastro efetuado com sucesso!";
						return $this->redirect(['/cliente/organizador']);
						//return $this->redirect($this->createUrl('/cliente/organizador'));
					} else Yii::$app->session->setFlash('error', 'E-mail já cadastrado!');//	throw new Exception("E-mail já cadastrado!");
				} else Yii::$app->session->setFlash('error', 'Campos não preenchidos corretamente!'); //	throw new Exception("Campos não preenchidos corretamente!");


			}

				return $this->render('/cadastro/create', [
					'model' => $objModelCliente,
					'endereco' => $objModelEndereco,
				]);
			
			
		} catch (Exception $e) {

			Yii::$app->session->setFlash('error', $e->getMessage()); //echo $e->getMessage();
		}
	}

	/**
	 * Updates an existing Usuario model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$objModelEndereco = new Endereco();

		if ($model->load(Yii::$app->request->post()) && $model->saveCliente()) {
			return $this->redirect(['/cadastro/view', 'id' => $model->INT_ID_CLIENTE]);
		} else {
			return $this->render('/cadastro/update', [
				'model' => $model,
				'endereco' => $objModelEndereco,
			]);
		}
	}

	/**
	 * Deletes an existing Usuario model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	public function actionSave()
	{
		try {			

			$objModelCliente = new Cliente();

			if( isset($_POST['Cliente']) ){
				$arrDados = $_POST['Cliente'];

				$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);
				if(empty($arrStatusEmail)){
					$intIdCliente = $objModelCliente->saveCliente($arrDados);
					Yii::$app->session->setFlash('success', 'cadastro efetuado com sucesso!'); // echo "cadastro efetuado com sucesso!";
					return $this->redirect(['/cliente/organizador']);
					//return $this->redirect(['/cliente/organizador'], array('id' => $intIdCliente));
				} else Yii::$app->session->setFlash('error', 'E-mail já cadastrado!');//	throw new Exception("E-mail já cadastrado!");
			} else Yii::$app->session->setFlash('error', 'Campos não preenchidos corretamente!'); //	throw new Exception("Campos não preenchidos corretamente!");				
			
		} catch (Exception $e) {

			Yii::$app->session->setFlash('error', $e->getMessage()); //echo $e->getMessage();
		}
	}

	/**
	 * Finds the Usuario model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Usuario the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Cliente::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}	
}