<?php

namespace frontend\modules\dashboard\controllers;

use Yii;
use common\models\Cliente;
use common\models\TipoCliente;
use common\models\Endereco;
use common\models\Status;
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
		$objSession = new Session;

		$intIdCliente = $objSession->get('INT_CLIENTE');

		$objModelCliente = $this->findModel($intIdCliente);
		if( isset($_POST['Cliente']) ) {
			$arrDados = $_POST['Cliente'];
			$arrDados['INT_ID_CLIENTE'] = $intIdCliente;
		}

		$arrEndereco['CLIENTE_INT_ID_CLIENTE'] = $intIdCliente;
		$objModelEndereco = $this->findEndereco($arrEndereco);

		return $this->render('/cliente/form', [
			'objModelCliente' => $objModelCliente,
			'objModelEndereco' => $objModelEndereco,
		]);

	}

	public function actionSave()
	{
		
		Yii::$app->response->format = Response::FORMAT_JSON;
		$arrResponse = array('message' => '', 'response' => false );

		$objModelCliente = new Cliente();
		$objModelEndereco = new Endereco();
		$objModelLog = new Log();
		$objSession = new Session;

		try {
			$arrDados = Yii::$app->request->post();

			$objModelCliente->attributes = $arrDados['Cliente'];

			if ($objModelCliente->validate()) {	

				$objModelEndereco->attributes = $arrDados['Endereco'];

				if ($objModelEndereco->validate()) {

					$arrCliente = $arrDados['Cliente'];
					$arrEndereco = $arrDados['Endereco'];
					$arrCliente['INT_ID_CLIENTE'] = $objSession->get('INT_CLIENTE');
					$arrCliente['STATUS_INT_ID_STATUS'] = Status::STATUS_ATIVO;

					$arrClienteAtivacao = $this->findModel($arrCliente['INT_ID_CLIENTE']);

					// Grava as alterações do Cliente
					$arrResult = $objModelCliente->saveCliente($arrCliente);
					if (!isset($arrResult['INT_ID_CLIENTE'])) 
						throw new \Exception($arrResult);

					$arrEndereco['CLIENTE_INT_ID_CLIENTE'] = $arrResult['INT_ID_CLIENTE'];

					$intIdEndereco = $objModelEndereco->saveEndereco($arrEndereco);
					
					if( $arrClienteAtivacao['STATUS_INT_ID_STATUS'] == Status::STATUS_AGUARDANDO ){
						// Envia o Email de Ativação 
						$arrCliente['STR_TIPO_ENVIO'] = 'ativacao';
						//EmailHelper::SendEmail($arrClienteAtivacao);

						$arrResponse['message'] = 'Ativação realizada com sucesso.';
					} else {
						// Envia o Email de Aviso de Alteração 
						$arrCliente['STR_TIPO_ENVIO'] = 'alteracao';
						//EmailHelper::SendEmail($arrClienteAtivacao);

						$arrResponse['message'] = 'Informações atualizadas com sucesso.';
					}
					
					$arrResponse['response'] = true;

				} else
					//$arrResponse['message'] = ['Não foi possivel realizar as alterações.'];
					$arrResponse['message'] = $objModelEndereco->errors;
			} else 
				$arrResponse['message'] =$objModelCliente->errors;
		
			return $arrResponse;

		} catch (\Exception $objExcessao) {

			$arrResponse = [
				'message' => [$objExcessao->getMessage()],
				'response' => false,
			];
			return $arrResponse;
		}

	}

	/**
	 * Finds the Cliente model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Cliente the loaded model
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

	/**
	 * Finds the Endereco model based on its primary key value.
	 * @param string $id
	 * @return Endereco the loaded model
	 */
	protected function findEndereco($id)
	{
		if (($model = Endereco::findOne($id)) !== null) {
			return $model;
		} else {
			return new Endereco();
		}
	}
}
