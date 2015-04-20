<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;

/**
 * This is the model class for table "evento".
 *
 * @property string $INT_ID_EVENTO
 * @property string $TIPO_EVENTO_INT_ID_TIPO_EVENTO
 * @property string $STATUS_INT_ID_STATUS
 * @property string $STR_NOME
 * @property string $STR_DESCRICAO
 * @property string $DAT_DATAHORA_INICIO
 * @property string $DAT_DATAHORA_FINAL
 * @property string $STR_LOCAL_REALIZACAO
 * @property string $STR_DATAHORA_REALIZACAO
 * @property string $STR_EMAIL_CONTATO
 * @property integer $INT_TELEFONE_DDI
 * @property integer $INT_TELEFONE_DDD
 * @property integer $INT_TELEFONE
 * @property integer $INT_FAX_DDI
 * @property integer $INT_FAX_DDD
 * @property integer $INT_FAX
 *
 * @property Atividade[] $atividades
 * @property CategoriaEvento[] $categoriaEventos
 * @property ClienteEvento[] $clienteEventos
 * @property EnderecoEvento[] $enderecoEventos
 * @property Estacionamento[] $estacionamentos
 * @property Status $sTATUSINTIDSTATUS
 * @property TipoEvento $tIPOEVENTOINTIDTIPOEVENTO
 * @property Hotevent[] $hotevents
 * @property Ingresso[] $ingressos
 * @property Portaria[] $portarias
 * @property Transacao[] $transacaos
 */
class Evento extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'STATUS_INT_ID_STATUS', 'STR_NOME', 'DAT_DATAHORA_INICIO', 'DAT_DATAHORA_FINAL', 'STR_LOCAL_REALIZACAO', 'STR_DATAHORA_REALIZACAO', 'STR_EMAIL_CONTATO'], 'required'],
            [['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'STATUS_INT_ID_STATUS', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX'], 'integer'],
            [['STR_DESCRICAO'], 'string'],
            [['DAT_DATAHORA_INICIO', 'DAT_DATAHORA_FINAL', 'STR_DATAHORA_REALIZACAO'], 'safe'],
            [['STR_NOME', 'STR_LOCAL_REALIZACAO'], 'string', 'max' => 255],
            [['STR_EMAIL_CONTATO'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INT_ID_EVENTO' => 'Código Evento',
            'TIPO_EVENTO_INT_ID_TIPO_EVENTO' => 'Tipo do Evento',
            'STATUS_INT_ID_STATUS' => 'Status',
            'STR_NOME' => 'Nome do evento',
            'STR_DESCRICAO' => 'Descrição do evento',
            'DAT_DATAHORA_INICIO' => 'Início do evento ',
            'DAT_DATAHORA_FINAL' => 'Término do evento',
            'STR_LOCAL_REALIZACAO' => 'Local',
            'STR_DATAHORA_REALIZACAO' => 'Data da Realizacao',
            'STR_EMAIL_CONTATO' => 'Email Contato',
            'INT_TELEFONE_DDI' => 'Telefone  Ddi',
            'INT_TELEFONE_DDD' => 'Telefone  Ddd',
            'INT_TELEFONE' => 'Telefone',
            'INT_FAX_DDI' => 'Fax Ddi',
            'INT_FAX_DDD' => 'Fax Ddd',
            'INT_FAX' => 'Fax',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtividades()
    {
        return $this->hasMany(Atividade::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaEventos()
    {
        return $this->hasMany(CategoriaEvento::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteEventos()
    {
        return $this->hasMany(ClienteEvento::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnderecoEventos()
    {
        return $this->hasMany(EnderecoEvento::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstacionamentos()
    {
        return $this->hasMany(Estacionamento::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSTATUSINTIDSTATUS()
    {
        return $this->hasOne(Status::className(), ['INT_ID_STATUS' => 'STATUS_INT_ID_STATUS']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTIPOEVENTOINTIDTIPOEVENTO()
    {
        return $this->hasOne(TipoEvento::className(), ['INT_ID_TIPO_EVENTO' => 'TIPO_EVENTO_INT_ID_TIPO_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotevents()
    {
        return $this->hasMany(Hotevent::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngressos()
    {
        return $this->hasMany(Ingresso::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortarias()
    {
        return $this->hasMany(Portaria::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransacaos()
    {
        return $this->hasMany(Transacao::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
    }
}
