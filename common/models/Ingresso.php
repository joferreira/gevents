<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingresso".
 *
 * @property string $INT_ID_INGRESSO
 * @property string $EVENTO_INT_ID_EVENTO
 * @property string $STR_DESCRICAO
 * @property integer $INT_QUANTIDADE
 * @property string $DAT_DATA_INICIO_VENDA
 * @property string $TIM_HORA_INICIO_VENDA
 * @property string $DAT_DATA_FINAL_VENDA
 * @property string $TIM_HORA_FINAL_VENDA
 * @property integer $INT_QUANTIDADE_MAXIMA_VENDA_PARTICIPANTE
 * @property string $STR_INGRESSO_RESTRITO
 * @property string $STR_TAXA_SERVICO
 *
 * @property Evento $eVENTOINTIDEVENTO
 * @property VoucherPromocional[] $voucherPromocionals
 */
class Ingresso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingresso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EVENTO_INT_ID_EVENTO', 'STR_DESCRICAO', 'DAT_DATA_INICIO_VENDA', 'TIM_HORA_INICIO_VENDA', 'DAT_DATA_FINAL_VENDA', 'TIM_HORA_FINAL_VENDA'], 'required'],
            [['EVENTO_INT_ID_EVENTO', 'INT_QUANTIDADE', 'INT_QUANTIDADE_MAXIMA_VENDA_PARTICIPANTE'], 'integer'],
            [['DAT_DATA_INICIO_VENDA', 'TIM_HORA_INICIO_VENDA', 'DAT_DATA_FINAL_VENDA', 'TIM_HORA_FINAL_VENDA'], 'safe'],
            [['STR_DESCRICAO'], 'string', 'max' => 150],
            [['STR_INGRESSO_RESTRITO', 'STR_TAXA_SERVICO'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INT_ID_INGRESSO' => 'Código Ingresso',
            'EVENTO_INT_ID_EVENTO' => 'Código Evento',
            'STR_DESCRICAO' => 'Descrição',
            'INT_QUANTIDADE' => 'Quantidade',
            'DAT_DATA_INICIO_VENDA' => 'Data Inicio Venda',
            'TIM_HORA_INICIO_VENDA' => 'Hora Inicio Venda',
            'DAT_DATA_FINAL_VENDA' => 'Data Final Venda',
            'TIM_HORA_FINAL_VENDA' => 'Hora Final Venda',
            'INT_QUANTIDADE_MAXIMA_VENDA_PARTICIPANTE' => 'Quantidade Maxima Venda Participante',
            'STR_INGRESSO_RESTRITO' => 'Ingresso Restrito',
            'STR_TAXA_SERVICO' => 'Taxa Serviço',
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
    public function getVoucherPromocionals()
    {
        return $this->hasMany(VoucherPromocional::className(), ['INGRESSO_INT_ID_INGRESSO' => 'INT_ID_INGRESSO']);
    }
}
