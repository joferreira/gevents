<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;

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
			[['STR_NOME_COMPLETO', 'STR_EMAIL'], 'required'],
			[['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE', 'TIPO_PESSOA_INT_ID_TIPO_PESSOA', 'STATUS_INT_ID_STATUS', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_CELULAR_DDI', 'INT_CELULAR_DDD', 'INT_CELULAR', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX'], 'integer'],
			[['DAT_DATA_NASCIMENTO', 'DAT_DATA_CADASTRO'], 'safe'],
			[['STR_NOME_COMPLETO'], 'string', 'max' => 200],
			[['STR_SEXO'], 'string', 'max' => 1],
			[['STR_CPF'], 'string', 'max' => 11],
			[['STR_CNPJ'], 'string', 'max' => 14],
			[['STR_RG'], 'string', 'max' => 10],
			[['STR_EMAIL'], 'string', 'max' => 150],
			[['STR_RAZAO_SOCIAL', 'STR_NOME_FANTASIA', 'STR_INSCRICAO_MUNICIPAL'], 'string', 'max' => 255],
			[['STR_CATEGORIA_EMPRESA'], 'string', 'max' => 6],

			[['STR_EMAIL', 'STR_NOME_COMPLETO', 'STR_SENHA', 'STR_SENHA_CONFIRME'], 'required', 'on'=>'register'],
			[['STR_SENHA','STR_SENHA_CONFIRME'], 'string', 'min' => 8, 'max' => 10, 'on'=>'register'],
			['STR_EMAIL', 'email', 'on'=>'register'],
			//['STR_SENHA_CONFIRME', 'compare', 'compareAttribute'=>'STR_SENHA', 'on'=>'register'],
			[['STR_SENHA'], 'safe', 'on'=>'register'],

			[['STR_EMAIL', 'STR_SENHA'], 'required', 'on'=>'login'],
			['STR_EMAIL', 'email', 'on'=>'login' ],
			[['STR_SENHA'], 'safe', 'on'=>'login'],

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
	public function verificaEmail($strEmail) {
		try {
			if (empty($strEmail))
				Yii::$app->session->setFlash('error', 'Parâmetro informado errado!'); 

			$arrResult = self::find()
					->where(["STR_EMAIL" => $strEmail])
					->one();
			
			if($arrResult)
				return $arrResult;
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

		$objTransaction = Yii::$app->db->beginTransaction();
		try {
			if (empty($arrDados))
				Yii::$app->session->setFlash('error', 'Campos Vazios!');

			// Insere os dados
			Yii::$app->db->createCommand()
				->insert(
					$this->tableName(), 
					[
						'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => TipoCliente::TIPO_CLIENTE_ORGANIZADOR,
						'STATUS_INT_ID_STATUS' => Status::STATUS_AGUARDANDO,
						'STR_NOME_COMPLETO' => $arrDados['STR_NOME_COMPLETO'],
						'STR_EMAIL' => $arrDados['STR_EMAIL'],
						'STR_SENHA' => md5($arrDados['STR_SENHA'])
					]
				)
				->execute();

			$intIdCliente = Yii::$app->db->getLastInsertID();

			$objTransaction->commit();

			/* Enviar Email de confirmação */

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

		$objTransaction = $objTransaction = Yii::$app->db->beginTransaction();
		try {
			if (empty($arrDados))
				Yii::$app->session->setFlash('error','Campos Vazios!');

			if( empty($arrDados['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE']) )
				throw new \Exception('Favor selecionar o Tipo Cliente!');

			//if( empty($arrDados['TIPO_PESSOA_INT_ID_TIPO_PESSOA']) )
			//	throw new \Exception('Favor selecionar o Tipo Pessoa!');

			if( empty($arrDados['STATUS_INT_ID_STATUS']) )
				throw new \Exception('Favor selecionar o Status!');

			$arrDados['DAT_DATA_NASCIMENTO'] = implode("-",array_reverse(explode("/",$arrDados['DAT_DATA_NASCIMENTO'])));

			if( isset($arrDados['INT_ID_CLIENTE']) ){
				
				Yii::$app->db->createCommand()
					->update(
						$this->tableName(), 
						$arrDados,
						[
							'INT_ID_CLIENTE' => $arrDados['INT_ID_CLIENTE'] 
						]
					)
					->execute();

				$arrResult['INT_ID_CLIENTE'] = $arrDados['INT_ID_CLIENTE'];
				$arrResult['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'] = $arrDados['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'];
			} else {

				$strSenha = isset($arrDados['STR_SENHA']) ? $arrDados['STR_SENHA'] : $this->generate_password();
				$arrDados['STR_SENHA'] = md5($strSenha);

				// Insere os dados
				Yii::$app->db->createCommand()
					->insert(
						$this->tableName(), 
						$arrDados
					)
					->execute();

				$arrResult['INT_ID_CLIENTE'] = Yii::$app->db->getLastInsertID();
				$arrResult['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'] = $arrDados['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'];
				$arrResult['STR_SENHA'] = $strSenha;
			}

			$objTransaction->commit();

			return $arrResult;

		} catch (\Exception $objExcessao) {
			$objTransaction->rollback();
			Yii::$app->session->setFlash('error', $objExcessao->getMessage());
		}
	}

	/**
	 * Método para deletear o cliente organizador / participante via admin.
	 *
	 * @param array Parâmetros do formulário
	 * @return integer Código do cliente gerado
	 */
	public function deleteCliente($arrDados = array()) {	

		$objTransaction = Yii::$app->db->beginTransaction();
		try {
			if (empty($arrDados))
				throw new \Exception('Campos Vazios!');

			// Altera os dados
			Yii::$app->db->createCommand()
				->update(
					$this->tableName(), 
					[
						'STATUS_INT_ID_STATUS' =>  Status::STATUS_INATIVO
					],
					[
						'INT_ID_CLIENTE' => $arrDados['INT_ID_CLIENTE'] 
					]
				)
				->execute();

			$intIdCliente = $arrDados['INT_ID_CLIENTE'];

			$objTransaction->commit();

			return $intIdCliente;

		} catch (Exception $objExcessao) {
			$objTransaction->rollback();
			echo $objExcessao->getMessage();
		}
	}

	/**
	 * Método para informar os dados do cliente.
	 * 
	 * @return object Database_Result|Array
	 * @throws Exception
	 */
	public function getClienteByTipoCliente($intTipoCliente) {
		try {
			$query = new Query;
			// compose the query
			$query->select('INT_ID_CLIENTE , TIPO_CLIENTE_INT_ID_TIPO_CLIENTE , TIPO_PESSOA_INT_ID_TIPO_PESSOA , STATUS_INT_ID_STATUS , STR_NOME_COMPLETO , DAT_DATA_NASCIMENTO , STR_SEXO , STR_CPF , STR_CNPJ , STR_RG , STR_EMAIL , STR_SENHA , INT_TELEFONE_DDI , INT_TELEFONE_DDD , INT_TELEFONE , INT_CELULAR_DDI , INT_CELULAR_DDD , INT_CELULAR , INT_FAX_DDI , INT_FAX_DDD , INT_FAX , STR_RAZAO_SOCIAL , STR_NOME_FANTASIA , STR_INSCRICAO_MUNICIPAL , STR_CATEGORIA_EMPRESA , DAT_DATA_CADASTRO')
			->from($this->tableName())
			->where(['TIPO_CLIENTE_INT_ID_TIPO_CLIENTE'=>$intTipoCliente]);

			$command = $query->createCommand();
			$arrResult = $command->queryAll();

		if ($arrResult)
				return $arrResult;
			else
				return FALSE;

		} catch (\Exception $objException) {
			throw $objException;
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
			
			if (empty($arrDados['STR_EMAIL']))
				throw new \yii\web\HttpException('Parâmetro e-mail necessário!');

			if (empty($arrDados['STR_SENHA']))
				throw new \yii\web\HttpException('Parâmetro senha necessário!');


			$objResult = self::find()
					->where(["STR_EMAIL" => $arrDados['STR_EMAIL']])
					->andWhere(["STR_SENHA" => md5($arrDados['STR_SENHA']) ])
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
