<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property string $INT_ID_CLIENTE
 * @property string $TIPO_CLIENTE_INT_ID_TIPO_CLIENTE
 * @property string $TIPO_PESSOA_INT_ID_TIPO_PESSOA
 * @property string $STATUS_INT_ID_STATUS
 * @property string $STR_NOME_COMPLETO
 * @property string $DAT_DATA_NASCIMENTO
 * @property string $STR_SEXO
 * @property string $STR_CPF
 * @property string $STR_CNPJ
 * @property string $STR_RG
 * @property string $STR_EMAIL
 * @property string $STR_SENHA
 * @property integer $INT_TELEFONE_DDI
 * @property integer $INT_TELEFONE_DDD
 * @property integer $INT_TELEFONE
 * @property integer $INT_CELULAR_DDI
 * @property integer $INT_CELULAR_DDD
 * @property integer $INT_CELULAR
 * @property integer $INT_FAX_DDI
 * @property integer $INT_FAX_DDD
 * @property integer $INT_FAX
 * @property string $STR_RAZAO_SOCIAL
 * @property string $STR_NOME_FANTASIA
 * @property string $STR_INSCRICAO_MUNICIPAL
 * @property string $STR_CATEGORIA_EMPRESA
 * @property string $DAT_DATA_CADASTRO
 *
 * @property Aceite[] $aceites
 * @property TipoPessoa $tIPOPESSOAINTIDTIPOPESSOA
 * @property Status $sTATUSINTIDSTATUS
 * @property TipoCliente $tIPOCLIENTEINTIDTIPOCLIENTE
 * @property ClienteEvento[] $clienteEventos
 * @property Endereco[] $enderecos
 * @property Log[] $logs
 * @property ReservaAtividade[] $reservaAtividades
 * @property ReservaEstacionamento[] $reservaEstacionamentos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', 'STATUS_INT_ID_STATUS', 'STR_NOME_COMPLETO', 'DAT_DATA_NASCIMENTO', 'STR_SEXO', 'STR_CPF', 'STR_CNPJ', 'STR_EMAIL', 'STR_SENHA', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_CELULAR_DDI', 'INT_CELULAR_DDD', 'INT_CELULAR', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX', 'STR_RAZAO_SOCIAL', 'STR_NOME_FANTASIA', 'STR_INSCRICAO_MUNICIPAL', 'STR_CATEGORIA_EMPRESA'], 'required'],
            [['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', 'STATUS_INT_ID_STATUS', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_CELULAR_DDI', 'INT_CELULAR_DDD', 'INT_CELULAR', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX'], 'integer'],
            [['DAT_DATA_NASCIMENTO', 'DAT_DATA_CADASTRO'], 'safe'],
            [['STR_NOME_COMPLETO'], 'string', 'max' => 200],
            [['STR_SEXO'], 'string', 'max' => 1],
            [['STR_CPF'], 'string', 'max' => 11],
            [['STR_CNPJ'], 'string', 'max' => 14],
            [['STR_RG'], 'string', 'max' => 10],
            [['STR_EMAIL'], 'string', 'max' => 150],
            [['STR_SENHA', 'STR_RAZAO_SOCIAL', 'STR_NOME_FANTASIA', 'STR_INSCRICAO_MUNICIPAL'], 'string', 'max' => 255],
            [['STR_CATEGORIA_EMPRESA'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INT_ID_CLIENTE' => 'Int  Id  Cliente',
            'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => 'Tipo  Cliente  Int  Id  Tipo  Cliente',
            'TIPO_PESSOA_INT_ID_TIPO_PESSOA' => 'Tipo  Pessoa  Int  Id  Tipo  Pessoa',
            'STATUS_INT_ID_STATUS' => 'Status  Int  Id  Status',
            'STR_NOME_COMPLETO' => 'Str  Nome  Completo',
            'DAT_DATA_NASCIMENTO' => 'Dat  Data  Nascimento',
            'STR_SEXO' => 'Str  Sexo',
            'STR_CPF' => 'Str  Cpf',
            'STR_CNPJ' => 'Str  Cnpj',
            'STR_RG' => 'Str  Rg',
            'STR_EMAIL' => 'Str  Email',
            'STR_SENHA' => 'Str  Senha',
            'INT_TELEFONE_DDI' => 'Int  Telefone  Ddi',
            'INT_TELEFONE_DDD' => 'Int  Telefone  Ddd',
            'INT_TELEFONE' => 'Int  Telefone',
            'INT_CELULAR_DDI' => 'Int  Celular  Ddi',
            'INT_CELULAR_DDD' => 'Int  Celular  Ddd',
            'INT_CELULAR' => 'Int  Celular',
            'INT_FAX_DDI' => 'Int  Fax  Ddi',
            'INT_FAX_DDD' => 'Int  Fax  Ddd',
            'INT_FAX' => 'Int  Fax',
            'STR_RAZAO_SOCIAL' => 'Str  Razao  Social',
            'STR_NOME_FANTASIA' => 'Str  Nome  Fantasia',
            'STR_INSCRICAO_MUNICIPAL' => 'Str  Inscricao  Municipal',
            'STR_CATEGORIA_EMPRESA' => 'Str  Categoria  Empresa',
            'DAT_DATA_CADASTRO' => 'Dat  Data  Cadastro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAceites()
    {
        return $this->hasMany(Aceite::className(), ['CLIENTE_INT_ID_CLIENTE' => 'INT_ID_CLIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTIPOPESSOAINTIDTIPOPESSOA()
    {
        return $this->hasOne(TipoPessoa::className(), ['INT_ID_TIPO_PESSOA' => 'TIPO_PESSOA_INT_ID_TIPO_PESSOA']);
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
    public function getTIPOCLIENTEINTIDTIPOCLIENTE()
    {
        return $this->hasOne(TipoCliente::className(), ['INT_ID_TIPO_CLIENTE' => 'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClienteEventos()
    {
        return $this->hasMany(ClienteEvento::className(), ['CLIENTE_INT_ID_CLIENTE' => 'INT_ID_CLIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnderecos()
    {
        return $this->hasMany(Endereco::className(), ['CLIENTE_INT_ID_CLIENTE' => 'INT_ID_CLIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogs()
    {
        return $this->hasMany(Log::className(), ['CLIENTE_INT_ID_CLIENTE' => 'INT_ID_CLIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservaAtividades()
    {
        return $this->hasMany(ReservaAtividade::className(), ['CLIENTE_INT_ID_CLIENTE' => 'INT_ID_CLIENTE']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservaEstacionamentos()
    {
        return $this->hasMany(ReservaEstacionamento::className(), ['CLIENTE_INT_ID_CLIENTE' => 'INT_ID_CLIENTE']);
    }
}
