<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Método de model de tipo cliente.
 * 
 * @package Model
 * @author Josemar Ferreira <jf.sorin@gmail.com>
 */

/**
 * This is the model class for table "tipo_cliente".
 *
 * @property string $INT_ID_TIPO_CLIENTE
 * @property string $STR_DESCRICAO
 *
 * @property Cliente[] $clientes
 */

class TipoCliente extends ActiveRecord
{
	const TIPO_CLIENTE_PARTICIPANTE = 1;
	const TIPO_CLIENTE_ORGANIZADOR = 2;
	const TIPO_CLIENTE_ORGANIZADOR_PARTICIPANTE = 3;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tipo_cliente';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INT_ID_TIPO_CLIENTE', 'STR_DESCRICAO'], 'required'],
			[['INT_ID_TIPO_CLIENTE'], 'integer'],
			[['STR_DESCRICAO'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_TIPO_CLIENTE' => 'Int  Id  Tipo  Cliente',
			'STR_DESCRICAO' => 'Str  Descricao',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getClientes()
	{
		return $this->hasMany(Cliente::className(), ['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => 'INT_ID_TIPO_CLIENTE']);
	}
}
