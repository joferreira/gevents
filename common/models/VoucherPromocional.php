<?php

namespace common\models;

use Yii;

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
class VoucherPromocional extends \yii\db\ActiveRecord
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
            'INT_ID_VOUCHER_PROMOCIONAL' => 'Int  Id  Voucher  Promocional',
            'INGRESSO_INT_ID_INGRESSO' => 'Ingresso  Int  Id  Ingresso',
            'STR_CODIGO' => 'Str  Codigo',
            'INT_QUANTIDADE_LIMITE' => 'Int  Quantidade  Limite',
            'INT_QUANTIDADE_UTILIZADA' => 'Int  Quantidade  Utilizada',
            'INT_GERADO_AUTOMATICAMENTE' => 'Int  Gerado  Automaticamente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINGRESSOINTIDINGRESSO()
    {
        return $this->hasOne(Ingresso::className(), ['INT_ID_INGRESSO' => 'INGRESSO_INT_ID_INGRESSO']);
    }
}
