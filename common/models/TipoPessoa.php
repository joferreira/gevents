<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Método de model de tipo pessoa.
 * 
 * @package Model
 * @author Josemar Ferreira <jf.sorin@gmail.com>
 */

/**
 * This is the model class for table "tipo_pessoa".
 *
 * @property string $INT_ID_TIPO_PESSOA
 * @property string $STR_DESCRICAO
 *
 * @property Cliente[] $clientes
 */

class TipoPessoa extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tipo_pessoa';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INT_ID_TIPO_PESSOA', 'STR_DESCRICAO'], 'required'],
			[['INT_ID_TIPO_PESSOA'], 'integer'],
			[['STR_DESCRICAO'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_TIPO_PESSOA' => 'Int  Id  Tipo  Pessoa',
			'STR_DESCRICAO' => 'Str  Descricao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getClientes()
	{
		return $this->hasMany(Cliente::className(), ['TIPO_PESSOA_INT_ID_TIPO_PESSOA' => 'INT_ID_TIPO_PESSOA']);
	}
}
