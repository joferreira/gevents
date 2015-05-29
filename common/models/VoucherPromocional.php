<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;

/**
 * This is the model class for table "voucher_promocional".
 *
 * @property string $INT_ID_VOUCHER_PROMOCIONAL
 * @property string $INGRESSO_INT_ID_INGRESSO
 * @property string $STR_CODIGO
 * @property integer $INT_QUANTIDADE_LIMITE
 * @property integer $INT_QUANTIDADE_UTILIZADA
 * @property integer $INT_GERADO_AUTOMATICAMENTE
 *
 * @property Ingresso $iNGRESSOINTIDINGRESSO
 */
class VoucherPromocional extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'voucher_promocional';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INGRESSO_INT_ID_INGRESSO', 'STR_CODIGO', 'INT_QUANTIDADE_LIMITE', 'INT_QUANTIDADE_UTILIZADA', 'INT_GERADO_AUTOMATICAMENTE'], 'required'],
			[['INGRESSO_INT_ID_INGRESSO', 'INT_QUANTIDADE_LIMITE', 'INT_QUANTIDADE_UTILIZADA', 'INT_GERADO_AUTOMATICAMENTE'], 'integer'],
			[['STR_CODIGO'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_VOUCHER_PROMOCIONAL' => 'Codigo Voucher Promocional',
			'INGRESSO_INT_ID_INGRESSO' => 'Codigo Ingresso',
			'STR_CODIGO' => 'Codigo',
			'INT_QUANTIDADE_LIMITE' => 'Quantidade Limite',
			'INT_QUANTIDADE_UTILIZADA' => 'Quantidade Utilizada',
			'INT_GERADO_AUTOMATICAMENTE' => 'Gerado Automaticamente',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getINGRESSOINTIDINGRESSO()
	{
		return $this->hasOne(Ingresso::className(), ['INT_ID_INGRESSO' => 'INGRESSO_INT_ID_INGRESSO']);
	}

	/**
	 * Método para salvar o evento.
	 * 
	 * @return integer Código do último Voucher Promocional
	 * @throws Exception
	 */
	public function saveVoucherPromocional($arrDados = array()) {
		try {
			
			$objTransaction = Yii::$app->db->beginTransaction();

			if( !empty($arrDados['INT_ID_VOUCHER_PROMOCIONAL']) ){
				
				Yii::$app->db->createCommand()
					->update(
						$this->tableName(), 
						$arrDados,
						[ 'INT_ID_VOUCHER_PROMOCIONAL' => $arrDados['INT_ID_VOUCHER_PROMOCIONAL'] ]
					)
					->execute();

				$arrResult['INT_ID_VOUCHER_PROMOCIONAL'] = $arrDados['INT_ID_VOUCHER_PROMOCIONAL'];

			} else {
				// Insere os dados
				Yii::$app->db->createCommand()
					->insert(
						$this->tableName(), 
						$arrDados
					)
					->execute();

				$arrResult['INT_ID_VOUCHER_PROMOCIONAL'] = Yii::$app->db->getLastInsertID();
			}

			$objTransaction->commit();

			return $arrResult;

		} catch (\Exception $objException) {
			$objTransaction->rollback();
			echo $objException;
		}
	}
}
