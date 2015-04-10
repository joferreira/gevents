<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use common\models\Cliente;
use common\models\TipoCliente;
use common\models\Endereco;
use common\models\Log;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Request;
use yii\web\Response;
use yii\helpers\EmailHelper;
use yii\web\Controller;
use yii\web\Session;

class CadastroController extends Controller
{
	public function actionIndex()
	{
		$session = new Session;

		$id = $session->get('INT_CLIENTE');

		$model = $this->findModel($id);
		if( isset($_POST['Cliente']) ) {
			$arrDados = $_POST['Cliente'];
			$arrDados['INT_ID_CLIENTE'] = $id;
		}

		$objModelEndereco = new Endereco();

		if ($model->load(Yii::$app->request->post()) && $model->saveCliente($arrDados)) {
			return $this->redirect(['/dashboard/']);
		} else {
			return $this->render('/cliente/form', [
				'model' => $model,
				'endereco' => $objModelEndereco,
			]);
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
