<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_cliente".
 *
 * @property string $INT_ID_TIPO_CLIENTE
 * @property string $STR_DESCRICAO
 *
 * @property Cliente[] $clientes
 */
class TipoCliente extends \yii\db\ActiveRecord
{
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
