<?php

namespace backend\controllers;

use Yii;
use common\models\Cliente;
use common\models\TipoCliente;
use common\models\Endereco;
use common\models\Log;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\EmailHelper;

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
		if ( Yii::$app->user->isGuest) 
			return $this->redirect(['/usuario/login']);

		$intTipoCliente = TipoCliente::TIPO_CLIENTE_ORGANIZADOR;
		$tituloPagina = 'Organizador';

		$searchModel = new Cliente();
		$dataProvider = $searchModel->getClienteByTipoCliente($intTipoCliente);

		return $this->render('/cliente/gridCliente', [
			'dataProvider' => $dataProvider,
			'tituloPagina' => $tituloPagina,
			'intTipoCliente' => $intTipoCliente,
		]);
	}
	/**
	 * Lista todos Participantes.
	 * @return mixed
	 */
	public function actionParticipante()
	{
		if ( Yii::$app->user->isGuest) 
			return $this->redirect(['/usuario/login']);
		
		$intTipoCliente = TipoCliente::TIPO_CLIENTE_PARTICIPANTE;
		$tituloPagina = 'Participante';

		$searchModel = new Cliente();
		$dataProvider = $searchModel->getClienteByTipoCliente($intTipoCliente);

		return $this->render('/cliente/gridCliente', [
			'dataProvider' => $dataProvider,
			'tituloPagina' => $tituloPagina,
			'intTipoCliente' => $intTipoCliente,
		]);
	}

	/**
	 * Lista todos Organizadores / Participantes.
	 * @return mixed
	 */
	public function actionOrganizadorparticipante()
	{
		if ( Yii::$app->user->isGuest)
			return $this->redirect(['/usuario/login']);

		$intTipoCliente = TipoCliente::TIPO_CLIENTE_ORGANIZADOR_PARTICIPANTE;
		$tituloPagina = 'Organizador/Participante';

		$searchModel = new Cliente();
		$dataProvider = $searchModel->getClienteByTipoCliente($intTipoCliente);

		return $this->render('/cliente/gridCliente', [
			'dataProvider' => $dataProvider,
			'tituloPagina' => $tituloPagina,
			'intTipoCliente' => $intTipoCliente,
		]);
	}
	/**
	 * Lists all Usuario models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		if ( Yii::$app->user->isGuest) {
			return $this->redirect(['/usuario/login']);
		}

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
		if ( Yii::$app->user->isGuest) {
			return $this->redirect(['/usuario/login']);
		} else {
			return $this->render('/cliente/view', [
				'model' => $this->findModel($id),
			]);
		}
	}
	/**
	 * Creates a new Usuario model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{

		if ( Yii::$app->user->isGuest) {
			return $this->redirect(['/usuario/login']);
		}

		$arrTipoCliente[TipoCliente::TIPO_CLIENTE_PARTICIPANTE] = 'participante';
		$arrTipoCliente[TipoCliente::TIPO_CLIENTE_ORGANIZADOR] = 'organizador';
		$arrTipoCliente[TipoCliente::TIPO_CLIENTE_ORGANIZADOR_PARTICIPANTE] = 'organizadorparticipante';

		try {

			$objModelCliente = new Cliente();
			$objModelEndereco = new Endereco();
			$objModelLog = new Log();

			if ($objModelCliente->load(Yii::$app->request->post()) ){

				if( isset($_POST['Cliente']) ){
					$arrDados = $_POST['Cliente'];

					$arrStatusEmail = $objModelCliente->verificaEmail($arrDados['STR_EMAIL']);

					if(empty($arrDados['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE']) ) {
						Yii::$app->session->setFlash('error','Favor selecionar o Tipo Cliente!');
					//} elseif(empty($arrDados['TIPO_PESSOA_INT_ID_TIPO_PESSOA']) ) {
					//	Yii::$app->session->setFlash('error','Favor selecionar o Tipo Pessoa!');
					} else if(empty($arrDados['STATUS_INT_ID_STATUS']) ){
						Yii::$app->session->setFlash('error','Favor selecionar o Status!');
					} else if(empty($arrDados['STR_EMAIL']) ) {
						Yii::$app->session->setFlash('error', 'E-mail não foi preenchido!');
					} else if(empty($arrStatusEmail)){
						$arrResult = $objModelCliente->saveCliente($arrDados);
						Yii::$app->session->setFlash('success', 'cadastro efetuado com sucesso! ');

						if( !isset($_POST['Cliente']['INT_ID_CLIENTE']) ){
							/* Salva o Log de Cadastro */
							$arrLog = array();
							$arrLog['CLIENTE_INT_ID_CLIENTE'] = $arrResult['INT_ID_CLIENTE'] ;
							$arrLog['STR_OCORRENCIA'] = Log::MENSAGEM_CADASTRO;
							$objModelLog->saveLog($arrLog);

							/* Envia o Email de confirmação */
							$arrDados['STR_TIPO_ENVIO'] = 'confirmacao';
							$arrDados['STR_SENHA'] = $arrResult['STR_SENHA'];
							EmailHelper::SendEmail($arrDados);
						}						

						return $this->redirect(['/cliente/'.$arrTipoCliente[$arrResult['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE']] ]);

					} else Yii::$app->session->setFlash('error', 'E-mail já cadastrado!');
				} else Yii::$app->session->setFlash('error', 'Campos não preenchidos corretamente!'); 


			}

			return $this->render('/cliente/create', [
				'model' => $objModelCliente,
				'endereco' => $objModelEndereco,
			]);
			
			
		} catch (\Exception $objExcessao) {

			Yii::$app->session->setFlash('error', $objExcessao->getMessage()); 
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
		if ( Yii::$app->user->isGuest) {
			return $this->redirect(['/usuario/login']);
		}

		$arrTipoCliente[TipoCliente::TIPO_CLIENTE_PARTICIPANTE] = 'participante';
		$arrTipoCliente[TipoCliente::TIPO_CLIENTE_ORGANIZADOR] = 'organizador';
		$arrTipoCliente[TipoCliente::TIPO_CLIENTE_ORGANIZADOR_PARTICIPANTE] = 'organizadorparticipante';

		$model = $this->findModel($id);
		if( isset($_POST['Cliente']) ) {
			$arrDados = $_POST['Cliente'];
			$arrDados['INT_ID_CLIENTE'] = $id;
		}

		$objModelEndereco = new Endereco();

		if ($model->load(Yii::$app->request->post()) && $model->saveCliente($arrDados)) {
			return $this->redirect(['/cliente/'.$arrTipoCliente[$model->TIPO_CLIENTE_INT_ID_TIPO_CLIENTE] ]);
		} else {
			return $this->render('/cliente/update', [
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
	public function actionDelete()
	{
		//$this->findModel($id)->delete();
		if ( Yii::$app->user->isGuest) {
			return $this->redirect(['/usuario/login']);
		}

		Yii::$app->response->format = Response::FORMAT_JSON;
		$arrResponse = array('message' => '', 'response' => false );

		try {
			$arrDados = Yii::$app->request->post();

			if (empty($arrDados['INT_ID_CLIENTE'])) {
				throw new \Exception("Parâmetro id cliente necessário!", 1);
			} else {

				$objModelCliente = new Cliente();

				$intIdCliente = $objModelCliente->deleteCliente($arrDados);
				if( !empty($intIdCliente ) ){
					$arrResponse['message'] = 'Inativação efetuada com sucesso! O organizador será notificado.';
					$arrResponse['response'] = true;
					/* Enviar o e-mail de notificação */
				} else
					throw new \Exception("Não foi possível inativar o cliente!", 1);

			}
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