<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;
use yii\web\Session;

/**
 * This is the model class for table "staff".
 *
 * @property string $INT_ID_STAFF
 * @property string $CLIENTE_INT_ID_CLIENTE
 * @property string $EVENTO_INT_ID_EVENTO
 * @property string $STR_GERENTE
 *
 * @property Cliente $cLIENTEINTIDCLIENTE
 * @property Evento $eVENTOINTIDEVENTO
 */
class Staff extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'staff';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['CLIENTE_INT_ID_CLIENTE', 'EVENTO_INT_ID_EVENTO', 'STR_GERENTE'], 'required'],
			[['CLIENTE_INT_ID_CLIENTE', 'EVENTO_INT_ID_EVENTO'], 'integer'],
			[['STR_GERENTE'], 'string', 'max' => 2]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_STAFF' => 'Int  Id  Staff',
			'CLIENTE_INT_ID_CLIENTE' => 'Cliente  Int  Id  Cliente',
			'EVENTO_INT_ID_EVENTO' => 'Evento  Int  Id  Evento',
			'STR_GERENTE' => 'Str  Gerente',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCLIENTEINTIDCLIENTE()
	{
		return $this->hasOne(Cliente::className(), ['INT_ID_CLIENTE' => 'CLIENTE_INT_ID_CLIENTE']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEVENTOINTIDEVENTO()
	{
		return $this->hasOne(Evento::className(), ['INT_ID_EVENTO' => 'EVENTO_INT_ID_EVENTO']);
	}

	/**
	 * Método para salvar o evento.
	 * 
	 * @return integer Código do último endereco evento
	 * @throws Exception
	 */
	public function saveStaffEvento($arrDados = array()) {
		try {
			
			$objTransaction = Yii::$app->db->beginTransaction();

			// Insere os dados
			Yii::$app->db->createCommand()
				->insert(
					$this->tableName(), 
					$arrDados
				)
				->execute();

			$arrResult['INT_ID_STAFF'] = Yii::$app->db->getLastInsertID();

			$objTransaction->commit();

			return $arrResult;

		} catch (Exception $objException) {
			$objTransaction->rollback();
			throw $objException;
		}
	}
}
