<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;

/**
 * Método de model de cliente.
 * 
 * @package Model
 * @author Josemar Ferreira <jf.sorin@gmail.com>
 */

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

class Cliente extends ActiveRecord
{

	public $STR_NOME_COMPLETO;
	public $STR_EMAIL;
	public $STR_SENHA;
	public $STR_SENHA_CONFIRME;

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
		//[['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', 'STATUS_INT_ID_STATUS', 'STR_NOME_COMPLETO', 'DAT_DATA_NASCIMENTO', 'STR_SEXO', 'STR_CPF', 'STR_CNPJ', 'STR_EMAIL', 'STR_SENHA', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_CELULAR_DDI', 'INT_CELULAR_DDD', 'INT_CELULAR', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX', 'STR_RAZAO_SOCIAL', 'STR_NOME_FANTASIA', 'STR_INSCRICAO_MUNICIPAL', 'STR_CATEGORIA_EMPRESA'], 'required'],

		return [
			[['STR_EMAIL', 'STR_NOME_COMPLETO', 'STR_SENHA', 'STR_SENHA_CONFIRME'], 'required', 'on'=>'register'],
			[['STR_SENHA','STR_SENHA_CONFIRME'], 'string', 'min' => 8, 'max' => 10, 'on'=>'register'],
			['STR_EMAIL', 'email', 'on'=>'register'],
			//['STR_SENHA_CONFIRME', 'compare', 'compareAttribute'=>'STR_SENHA', 'on'=>'register'],
			[['STR_SENHA'], 'safe', 'on'=>'register'],

			[['STR_EMAIL', 'STR_SENHA'], 'required', 'on'=>'login'],
			['STR_EMAIL', 'email', 'on'=>'login' ],
			[['STR_SENHA'], 'safe', 'on'=>'login']
/*
			[['STR_NOME_COMPLETO', 'STR_EMAIL'], 'required'],
			[['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', 'STATUS_INT_ID_STATUS', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_CELULAR_DDI', 'INT_CELULAR_DDD', 'INT_CELULAR', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX'], 'integer'],
			[['DAT_DATA_NASCIMENTO', 'DAT_DATA_CADASTRO'], 'safe'],
			[['STR_NOME_COMPLETO'], 'string', 'max' => 200],
			[['STR_SEXO'], 'string', 'max' => 1],
			[['STR_CPF'], 'string', 'max' => 11],
			[['STR_CNPJ'], 'string', 'max' => 14],
			[['STR_RG'], 'string', 'max' => 10],
			[['STR_EMAIL'], 'string', 'max' => 150],
			[[ 'STR_RAZAO_SOCIAL', 'STR_NOME_FANTASIA', 'STR_INSCRICAO_MUNICIPAL'], 'string', 'max' => 255],
			[['STR_CATEGORIA_EMPRESA'], 'string', 'max' => 6]
*/
			
			//['confirmesenha', 'compare', 'compareAttribute' => 'STR_SENHA']
		];
	}
	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios['login'] = ['STR_EMAIL', 'STR_SENHA'];
		$scenarios['register'] = ['STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_SENHA','STR_SENHA_CONFIRME'];
		return $scenarios;	
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_CLIENTE' => 'Id Cliente',
			'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => 'Tipo Cliente',
			'TIPO_PESSOA_INT_ID_TIPO_PESSOA' => 'Tipo Pessoa',
			'STATUS_INT_ID_STATUS' => 'Status',
			'STR_NOME_COMPLETO' => 'Nome Completo',
			'DAT_DATA_NASCIMENTO' => 'Data Nascimento',
			'STR_SEXO' => 'Sexo',
			'STR_CPF' => 'Cpf',
			'STR_CNPJ' => 'Cnpj',
			'STR_RG' => 'Rg',
			'STR_EMAIL' => 'Email',
			'STR_SENHA' => 'Senha',
			'INT_TELEFONE_DDI' => 'Telefone Ddi',
			'INT_TELEFONE_DDD' => 'Telefone Ddd',
			'INT_TELEFONE' => 'Telefone',
			'INT_CELULAR_DDI' => 'Celular Ddi',
			'INT_CELULAR_DDD' => 'Celular Ddd',
			'INT_CELULAR' => 'Celular',
			'INT_FAX_DDI' => 'Fax Ddi',
			'INT_FAX_DDD' => 'Fax Ddd',
			'INT_FAX' => 'Fax',
			'STR_RAZAO_SOCIAL' => 'Razao Social',
			'STR_NOME_FANTASIA' => 'Nome Fantasia',
			'STR_INSCRICAO_MUNICIPAL' => 'Inscricao Municipal',
			'STR_CATEGORIA_EMPRESA' => 'Categoria Empresa',
			'DAT_DATA_CADASTRO' => 'Data Cadastro',
			'STR_SENHA_CONFIRME' => 'Confirmar Senha',
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

	/**
	 * Método para verificação de e-mail existente.
	 * 
	 * @param string E-mail
	 * @return array Database_Result|Array
	 */
	public function verificaEmail($STR_EMAIL) {
		try {
			if (empty($STR_EMAIL))
				Yii::$app->session->setFlash('error', 'Parâmetro informado errado!'); 

			$objResult = self::find()
					->where(["STR_EMAIL" => $STR_EMAIL])
					->one();
			
			if($objResult)
				return $objResult;
			else
				return FALSE;
		} catch (Exception $objExcessao) {
			echo $objExcessao->getMessage();
		}
	}

	/**
	 * Método para salvar cliente organizador .
	 *
	 * @param array Parâmetros do formulário
	 * @return integer Código do cliente gerado
	 */
	public function saveOrganizador($arrDados = array()) {

		$connection = \Yii::$app->db;
		$objTransaction = $connection->beginTransaction();
		try {
			if (empty($arrDados))
				Yii::$app->session->setFlash('error', 'Campos Vazios!');

			// Insere os dados
			$connection->createCommand()
				->insert(
					$this->tableName(), 
					[
						'STATUS_INT_ID_STATUS' => Status::STATUS_AGUARDANDO,
						'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => Status::STATUS_AGUARDANDO,
						'STR_NOME_COMPLETO' => $arrDados['STR_NOME_COMPLETO'],
						'STR_EMAIL' => $arrDados['STR_EMAIL'],
						'STR_SENHA' => $arrDados['STR_SENHA']
					]
				)
				->execute();

			$objTransaction->commit();

			$intIdCliente = self::getPrimaryKey(); 

			return $intIdCliente;

		} catch (Exception $objExcessao) {
			$objTransaction->rollback();
			echo $objExcessao->getMessage();
		}
	}

	/**
	 * Método para salvar cliente organizador / participante via admin.
	 *
	 * @param array Parâmetros do formulário
	 * @return integer Código do cliente gerado
	 */
	public function saveCliente($arrDados = array()) {

		$connection = \Yii::$app->db;
		$objTransaction = $connection->beginTransaction();
		try {
			if (empty($arrDados))
				throw new Exception('Campos Vazios!');

			$strSenha = empty($arrDados['STR_SENHA']) ? $this->generate_password() : $arrDados['STR_SENHA'];

			$DAT_DATA_NASCIMENTO = implode("-",array_reverse(explode("/",$arrDados['DAT_DATA_NASCIMENTO'])));

			// Insere os dados
			$connection->createCommand()
				->insert(
					$this->tableName(), 
					[
						'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => $arrDados['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'],
						'TIPO_PESSOA_INT_ID_TIPO_PESSOA' => $arrDados['TIPO_PESSOA_INT_ID_TIPO_PESSOA'],
						'STATUS_INT_ID_STATUS' => $arrDados['STATUS_INT_ID_STATUS'],
						'STR_NOME_COMPLETO' => $arrDados['STR_NOME_COMPLETO'],
						'DAT_DATA_NASCIMENTO' => $DAT_DATA_NASCIMENTO,
						'STR_SEXO' => $arrDados['STR_SEXO'],
						'STR_CPF' => $arrDados['STR_CPF'],
						'STR_CNPJ' => $arrDados['STR_CNPJ'],
						'STR_RG' => $arrDados['STR_RG'],
						'STR_EMAIL' => $arrDados['STR_EMAIL'],
						'STR_SENHA' => $strSenha ,
						'INT_TELEFONE_DDI' => $arrDados['INT_TELEFONE_DDI'],
						'INT_TELEFONE_DDD' => $arrDados['INT_TELEFONE_DDD'],
						'INT_TELEFONE' => $arrDados['INT_TELEFONE'],
						'INT_CELULAR_DDI' => $arrDados['INT_CELULAR_DDI'],
						'INT_CELULAR_DDD' => $arrDados['INT_CELULAR_DDD'],
						'INT_CELULAR' => $arrDados['INT_CELULAR'],
						'INT_FAX_DDI' => $arrDados['INT_FAX_DDI'],
						'INT_FAX_DDD' => $arrDados['INT_FAX_DDD'],
						'INT_FAX' => $arrDados['INT_FAX'],
						'STR_RAZAO_SOCIAL' => $arrDados['STR_RAZAO_SOCIAL'],
						'STR_NOME_FANTASIA' => $arrDados['STR_NOME_FANTASIA'],
						'STR_INSCRICAO_MUNICIPAL' => $arrDados['STR_INSCRICAO_MUNICIPAL'],
						'STR_CATEGORIA_EMPRESA' => $arrDados['STR_CATEGORIA_EMPRESA']
					]
				)
				->execute();

			$objTransaction->commit();

			$intIdCliente = self::getPrimaryKey(); 

			return $intIdCliente;

		} catch (Exception $objExcessao) {
			$objTransaction->rollback();
			echo $objExcessao->getMessage();
		}
	}	

	/**
	 * Description
	 * @param type $intLength
	 * @return type $strSenha
	 */
	function generate_password($length = 10){
		$chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.'0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|';

		$str = '';
		$max = strlen($chars) - 1;

		for ($i=0; $i < $length; $i++)
			$str .= $chars[mt_rand(0, $max)];

		return $str;
	}

	/**
	 * Método para salvar cliente inicial.
	 * 
	 * @param array Parâmetros do formulário
	 * @return integer Código do cliente gerado
	 */
	public function saveClienteInicial($arrDados = array()) {
		try {
			if (empty($arrDados))
				throw new Exception('Parâmetros necessários!');

			$objTransaction = Yii::app()->db->beginTransaction();

			// Insere dados iniciais
			Yii::app()->db->createCommand()
					->insert(
							$this->tableName(), array(
						'STR_NOME' => $arrDados['STR_NOME'],
						'STR_NOME_COMPLEMENTO' => $arrDados['STR_NOME_COMPLEMENTO'],
						'STR_EMAIL' => $arrDados['STR_EMAIL'],
						'STR_SENHA' => $arrDados['STR_SENHA'],
						'STR_SENHA_CONFIRMACAO' => $arrDados['STR_SENHA_CONFIRMACAO'])
			);


			$objTransaction->commit();

			$intMaxIdCliente = Yii::app()->db->createCommand()
					->select('MAX(INT_ID_CLIENTE) as MAX_INT_ID_CLIENTE')
					->from($this->tableName())
					->queryScalar();

			return $intMaxIdCliente;
		} catch (Exception $objExcessao) {
			$objTransaction->rollback();
			echo 'Exception: ' . $objExcessao->getMessage() . '</br>';
		}
	}

	/** Login do cliente */

	/**
	 * Método para verificação de e-mail e senha de acesso.
	 * 
	 * @param stringer E-mail
	 * @param stringer Senha
	 * @return array Database_Result|Array
	 */
	public function verificaEmailSenha($arrDados = array()) {
		try {
			$connection = \Yii::$app->db;
			if (empty($arrDados['STR_EMAIL']))
				throw new \yii\web\HttpException('Parâmetro e-mail necessário!');

			if (empty($arrDados['STR_SENHA']))
				throw new \yii\web\HttpException('Parâmetro senha necessário!');


			$objResult = self::find()
					->where(["STR_EMAIL" => $arrDados['STR_EMAIL']])
					->andWhere(["STR_SENHA" =>  $arrDados['STR_SENHA']])
					->one();

			if ($objResult)
				return $objResult;
			else
				return FALSE;
		} catch (Exception $objException) {
			throw $objException;
		}
	}
}
