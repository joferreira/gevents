<?php

namespace backend\controllers;

use Yii;
use common\models\Cliente;
use backend\models\OrganizadorSearch;
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

	/**
	 * Lista todos Organizadores.
	 * @return mixed
	 */
	public function actionOrganizador()
	{
		$searchModel = new OrganizadorSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('/cadastro\organizador', [
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
		return $this->render('/cadastro\view', [
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
		$model = new Cliente();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->INT_ID_CLIENTE]);
		} else {
			return $this->render('/cadastro\create', [
				'model' => $model,
			]);
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

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->INT_ID_CLIENTE]);
		} else {
			return $this->render('/cadastro\update', [
				'model' => $model,
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