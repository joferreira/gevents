<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
/**
 * This is the model class for table "maps_google".
 *
 * @property string $INT_ID_MAPS_GOOGLE
 * @property string $ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO
 *
 * @property EnderecoEvento $eNDERECOEVENTOINTIDENDERECOEVENTO
 */
class MapsGoogle extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'maps_google';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'], 'required'],
			[['ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO'], 'integer']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_MAPS_GOOGLE' => 'Gostaria de exibir endereço no Google Maps?',
			'ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO' => 'Código Endereço Evento',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getENDERECOEVENTOINTIDENDERECOEVENTO()
	{
		return $this->hasOne(EnderecoEvento::className(), ['INT_ID_ENDERECO_EVENTO' => 'ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO']);
	}

	/**
	 * Método para salvar a exibição do Maps Google.
	 * 
	 * @return integer Código do último evento
	 * @throws Exception
	 */
	public function insertMapsGoogle($arrDados = array()) {
		try {
			
			$objTransaction = Yii::$app->db->beginTransaction();

			// Insere os dados
			Yii::$app->db->createCommand()
				->insert(
					$this->tableName(), 
					$arrDados
				)
				->execute();

			$arrResult['INT_ID_MAPS_GOOGLE'] = Yii::$app->db->getLastInsertID();

			$objTransaction->commit();

			return $arrResult;

		} catch (\Exception $objException) {
			$objTransaction->rollback();
			echo $objException;
		}
	}
	
}
