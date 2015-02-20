<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property string $INT_ID_STATUS
 * @property string $STR_DESCRICAO_STATUS
 *
 * @property Cliente[] $clientes
 * @property Evento[] $eventos
 */
class Status extends \yii\db\ActiveRecord
{
	const STATUS_ATIVO = 1;
	const STATUS_AGUARDANDO = 2;
	const STATUS_INATIVO = 3;
	const STATUS_CANCELADO = 4;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'status';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INT_ID_STATUS', 'STR_DESCRICAO_STATUS'], 'required'],
			[['INT_ID_STATUS'], 'integer'],
			[['STR_DESCRICAO_STATUS'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_STATUS' => 'Int  Id  Status',
			'STR_DESCRICAO_STATUS' => 'Str  Descricao  Status',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getClientes()
	{
		return $this->hasMany(Cliente::className(), ['STATUS_INT_ID_STATUS' => 'INT_ID_STATUS']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEventos()
	{
		return $this->hasMany(Evento::className(), ['STATUS_INT_ID_STATUS' => 'INT_ID_STATUS']);
	}
}
