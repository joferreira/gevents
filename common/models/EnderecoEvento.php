<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "endereco_evento".
 *
 * @property string $INT_ID_ENDERECO_EVENTO
 * @property string $EVENTO_INT_ID_EVENTO
 * @property string $UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL
 * @property string $STR_ENDERECO
 * @property string $STR_NUMERO
 * @property string $STR_COMPLEMENTO
 * @property string $STR_BAIRRO
 * @property string $STR_MUNICIPIO
 * @property integer $INT_CEP
 * @property string $STR_CAIXA_POSTAL
 *
 * @property Evento $eVENTOINTIDEVENTO
 * @property UnidadeFederal $uNIDADEFEDERALINTIDUNIDADEFEDERAL
 * @property MapsGoogle[] $mapsGoogles
 */
class EnderecoEvento extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'endereco_evento';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['EVENTO_INT_ID_EVENTO', 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL', 'STR_ENDERECO', 'STR_NUMERO', 'STR_BAIRRO', 'STR_MUNICIPIO', 'INT_CEP'], 'required'],
			[['EVENTO_INT_ID_EVENTO', 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL', 'INT_CEP'], 'integer'],
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
			'INT_ID_ENDERECO_EVENTO' => 'Int  Id  Endereco  Evento',
			'EVENTO_INT_ID_EVENTO' => 'Id  Evento',
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
	public function getEVENTOINTIDEVENTO()
	{
		return $this->hasOne(Evento::className(), ['INT_ID_EVENTO' => 'EVENTO_INT_ID_EVENTO']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUNIDADEFEDERALINTIDUNIDADEFEDERAL()
	{
		return $this->hasOne(UnidadeFederal::className(), ['INT_ID_UNIDADE_FEDERAL' => 'UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMapsGoogles()
	{
		return $this->hasMany(MapsGoogle::className(), ['ENDERECO_EVENTO_INT_ID_ENDERECO_EVENTO' => 'INT_ID_ENDERECO_EVENTO']);
	}
}
