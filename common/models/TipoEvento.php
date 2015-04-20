<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tipo_evento".
 *
 * @property string $INT_ID_TIPO_EVENTO
 * @property string $STR_DESCRICAO
 *
 * @property Evento[] $eventos
 */
class TipoEvento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INT_ID_TIPO_EVENTO', 'STR_DESCRICAO'], 'required'],
            [['INT_ID_TIPO_EVENTO'], 'integer'],
            [['STR_DESCRICAO'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INT_ID_TIPO_EVENTO' => 'Int  Id  Tipo  Evento',
            'STR_DESCRICAO' => 'Str  Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['TIPO_EVENTO_INT_ID_TIPO_EVENTO' => 'INT_ID_TIPO_EVENTO']);
    }
}
