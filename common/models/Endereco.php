<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;


/**
 * Método de model de endereço.
 * 
 * @package Model
 * @author Josemar Ferreira <jf.sorin@gmail.com>
 */

/**
 * This is the model class for table "endereco".
 *
 * @property string $INT_ID_ENDERECO
 * @property string $CLIENTE_INT_ID_CLIENTE
 * @property string $UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL
 * @property string $STR_ENDERECO
 * @property string $STR_NUMERO
 * @property string $STR_COMPLEMENTO
 * @property string $STR_BAIRRO
 * @property string $STR_MUNICIPIO
 * @property integer $INT_CEP
 * @property string $STR_CAIXA_POSTAL
 *
 * @property Cliente $cLIENTEINTIDCLIENTE
 * @property UnidadeFederal $uNIDADEFEDERALINTIDUNIDADEFEDERAL
 */

class Endereco extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'endereco';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL'], 'required'],
			[['STR_ENDERECO','STR_NUMERO','STR_BAIRRO','STR_MUNICIPIO','INT_CEP'], 'required'],
			[['CLIENTE_INT_ID_CLIENTE', 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL', 'INT_CEP'], 'integer'],
			[['STR_ENDERECO'], 'string', 'max' => 255],
			[['STR_NUMERO', 'STR_CAIXA_POSTAL'], 'string', 'max' => 10],
			[['STR_COMPLEMENTO', 'STR_BAIRRO', 'STR_MUNICIPIO'], 'string', 'max' => 150]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_ENDERECO' => 'Id Endereco',
			'CLIENTE_INT_ID_CLIENTE' => 'Id Cliente',
			'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL' => 'UF',
			'STR_ENDERECO' => 'Endereco',
			'STR_NUMERO' => 'Numero',
			'STR_COMPLEMENTO' => 'Complemento',
			'STR_BAIRRO' => 'Bairro',
			'STR_MUNICIPIO' => 'Municipio',
			'INT_CEP' => 'Cep',
			'STR_CAIXA_POSTAL' => 'Caixa Postal',
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
	public function getUNIDADEFEDERALINTIDUNIDADEFEDERAL()
	{
		return $this->hasOne(UnidadeFederal::className(), ['INT_ID_UNIDADE_FEDERAL' => 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL']);
	}

	public function saveEndereco($arrDados = array())
	{
		$objTransaction = Yii::$app->db->beginTransaction();
		try {
			if (empty($arrDados))
				throw new \Exception('Campos Vazios!');

			if( isset($arrDados['INT_ID_ENDERECO']) ){
				
				Yii::$app->db->createCommand()
					->update(
						$this->tableName(), 
						$arrDados,
						[
							'INT_ID_ENDERECO' => $arrDados['INT_ID_ENDERECO'] 
						]
					)
					->execute();

				$arrResult['INT_ID_ENDERECO'] = $arrDados['INT_ID_ENDERECO'];

			} else {

				// Insere os dados
				Yii::$app->db->createCommand()
					->insert(
						$this->tableName(), 
						$arrDados
					)
					->execute();

				$arrResult['INT_ID_ENDERECO'] = Yii::$app->db->getLastInsertID();

			}

			$objTransaction->commit();

			return $arrResult;

		} catch (\Exception $objExcessao) {
			$objTransaction->rollback();
			return $arrResult['error'] = $objExcessao->getMessage();
		}
	}

}
