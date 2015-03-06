<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * Método de model de unidade federal.
 * 
 * @package Model
 * @author Josemar Ferreira <jf.sorin@gmail.com>
 */

/**
 * This is the model class for table "unidade_federal".
 *
 * @property string $INT_ID_UNIDADE_FEDERAL
 * @property string $STR_DESCRICAO_UNIDADE_FEDERAL
 * @property string $STR_SIGLA_UNIDADE_FEDERAL
 *
 * @property Endereco[] $enderecos
 * @property EnderecoEvento[] $enderecoEventos
 */

class UnidadeFederal extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'unidade_federal';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INT_ID_UNIDADE_FEDERAL', 'STR_DESCRICAO_UNIDADE_FEDERAL', 'STR_SIGLA_UNIDADE_FEDERAL'], 'required'],
			[['INT_ID_UNIDADE_FEDERAL'], 'integer'],
			[['STR_DESCRICAO_UNIDADE_FEDERAL'], 'string', 'max' => 150],
			[['STR_SIGLA_UNIDADE_FEDERAL'], 'string', 'max' => 2]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_UNIDADE_FEDERAL' => 'Int  Id  Unidade  Federal',
			'STR_DESCRICAO_UNIDADE_FEDERAL' => 'Str  Descricao  Unidade  Federal',
			'STR_SIGLA_UNIDADE_FEDERAL' => 'Str  Sigla  Unidade  Federal',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEnderecos()
	{
		return $this->hasMany(Endereco::className(), ['UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL' => 'INT_ID_UNIDADE_FEDERAL']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEnderecoEventos()
	{
		return $this->hasMany(EnderecoEvento::className(), ['UNIDADE_FEDERAL_INT_ID_UNIDADE_FEDERAL' => 'INT_ID_UNIDADE_FEDERAL']);
	}
}
