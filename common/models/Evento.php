<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;
use yii\web\Session;

/**
 * This is the model class for table "evento".
 *
 * @property string $INT_ID_EVENTO
 * @property string $TIPO_EVENTO_INT_ID_TIPO_EVENTO
 * @property string $STATUS_INT_ID_STATUS
 * @property string $STR_NOME
 * @property string $STR_DESCRICAO
 * @property string $DAT_DATA_INICIO
 * @property string $DAT_DATA_FINAL
 * @property string $TIM_HORA_INICIO
 * @property string $TIM_HORA_FINAL
 * @property string $STR_LOCAL_REALIZACAO
 * @property string $STR_EMAIL_CONTATO
 * @property integer $INT_TELEFONE_DDI
 * @property integer $INT_TELEFONE_DDD
 * @property integer $INT_TELEFONE
 * @property integer $INT_FAX_DDI
 * @property integer $INT_FAX_DDD
 * @property integer $INT_FAX
 * @property integer $INT_PAGAMENTO_ATIVO
 * @property string $STR_PUBLICACAO
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
 * @property Log[] $logs
 * @property Portaria[] $portarias
 * @property Staff[] $staff
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
			[['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'STATUS_INT_ID_STATUS', 'STR_NOME', 'DAT_DATA_INICIO', 'DAT_DATA_FINAL', 'TIM_HORA_INICIO', 'TIM_HORA_FINAL', 'STR_LOCAL_REALIZACAO', 'STR_EMAIL_CONTATO', 'STR_PUBLICACAO'], 'required'],
			[['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'STATUS_INT_ID_STATUS', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX', 'INT_PAGAMENTO_ATIVO'], 'integer'],
			[['STR_DESCRICAO'], 'string'],
			[['DAT_DATA_INICIO', 'DAT_DATA_FINAL', 'TIM_HORA_INICIO', 'TIM_HORA_FINAL'], 'safe'],
			[['STR_NOME', 'STR_LOCAL_REALIZACAO'], 'string', 'max' => 255],
			[['STR_EMAIL_CONTATO'], 'string', 'max' => 150],
			[['STR_PUBLICACAO'], 'string', 'max' => 2],

			// Regras de validação de criação
			[['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'STR_NOME', 'DAT_DATA_INICIO', 'DAT_DATA_FINAL', 'STR_LOCAL_REALIZACAO', 'STR_EMAIL_CONTATO', 'STR_PUBLICACAO', 'INT_PAGAMENTO_ATIVO', 'MINUTO_FINAL'], 'required', 'on' => 'criacao'],
			[['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'INT_TELEFONE_DDI', 'INT_TELEFONE_DDD', 'INT_TELEFONE', 'INT_FAX_DDI', 'INT_FAX_DDD', 'INT_FAX', 'INT_PAGAMENTO_ATIVO'], 'integer', 'on' => 'criacao'],
			[['STR_DESCRICAO'], 'string', 'on' => 'criacao'],
			[['DAT_DATA_INICIO', 'DAT_DATA_FINAL', 'TIM_HORA_INICIO', 'TIM_HORA_FINAL'], 'safe', 'on' => 'criacao'],
			[['STR_NOME', 'STR_LOCAL_REALIZACAO'], 'string', 'max' => 255, 'on' => 'criacao'],
			[['STR_EMAIL_CONTATO'], 'string', 'max' => 150, 'on' => 'criacao'],
			[['STR_PUBLICACAO'], 'string', 'max' => 2, 'on' => 'criacao'],
			[['MINUTO_FINAL'], 'integer', 'on' => 'criacao']
		];
	}

	public function scenarios()
	{
		$scenarios = parent::scenarios();
		$scenarios['criacao'] = ['TIPO_EVENTO_INT_ID_TIPO_EVENTO', 'STR_NOME', 'DAT_DATA_INICIO', 'DAT_DATA_FINAL', 'STR_LOCAL_REALIZACAO', 'STR_EMAIL_CONTATO', 'STR_PUBLICACAO', 'INT_PAGAMENTO_ATIVO', 'MINUTO_FINAL'];
		//$scenarios['register'] = ['STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_SENHA','STR_SENHA_CONFIRME'];
		return $scenarios;	
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_EVENTO' => 'Código Evento',
			'TIPO_EVENTO_INT_ID_TIPO_EVENTO' => 'Tipo Evento',
			'STATUS_INT_ID_STATUS' => 'Status',
			'STR_NOME' => 'Nome',
			'STR_DESCRICAO' => 'Descrição',
			'DAT_DATA_INICIO' => 'Data Inicio',
			'DAT_DATA_FINAL' => 'Data Final',
			'TIM_HORA_INICIO' => 'Hora Inicio',
			'TIM_HORA_FINAL' => 'Hora Final',
			'STR_LOCAL_REALIZACAO' => 'Local Realização',
			'STR_EMAIL_CONTATO' => 'Email Contato',
			'INT_TELEFONE_DDI' => 'Telefone Ddi',
			'INT_TELEFONE_DDD' => 'Telefone Ddd',
			'INT_TELEFONE' => 'Telefone',
			'INT_FAX_DDI' => 'Fax Ddi',
			'INT_FAX_DDD' => 'Fax Ddd',
			'INT_FAX' => 'Fax',
			'INT_PAGAMENTO_ATIVO' => 'Seu evento é pago?',
			'STR_PUBLICACAO' => 'Seu evento é',
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
	public function getLogs()
	{
		return $this->hasMany(Log::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
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
	public function getStaff()
	{
		return $this->hasMany(Staff::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTransacaos()
	{
		return $this->hasMany(Transacao::className(), ['EVENTO_INT_ID_EVENTO' => 'INT_ID_EVENTO']);
	}

	/**
	 * Método para salvar o evento.
	 * 
	 * @return integer Código do último evento
	 * @throws Exception
	 */
	public function saveEvento($arrDados = array()) {
		try {
			
			$objTransaction = Yii::$app->db->beginTransaction();

			$arrDados['DAT_DATA_INICIO'] = implode("-",array_reverse(explode("/",$arrDados['DAT_DATA_INICIO'])));
			$arrDados['DAT_DATA_FINAL'] = implode("-",array_reverse(explode("/",$arrDados['DAT_DATA_FINAL'])));

			$arrDados['TIM_HORA_INICIO'] = $arrDados['hora_inicio'].':'.$arrDados['minuto_inicio'].':00';
			$arrDados['TIM_HORA_FINAL'] = $arrDados['hora_final'].':'.$arrDados['minuto_final'].':00';

			unset($arrDados['hora_inicio']);
			unset($arrDados['minuto_inicio']);
			unset($arrDados['hora_final']);
			unset($arrDados['minuto_final']);

			if( !empty($arrDados['INT_ID_EVENTO']) ){
				
				Yii::$app->db->createCommand()
					->update(
						$this->tableName(), 
						$arrDados,
						[ 'INT_ID_EVENTO' => $arrDados['INT_ID_EVENTO'] ]
					)
					->execute();

				$arrResult['INT_ID_EVENTO'] = $arrDados['INT_ID_EVENTO'];

			} else {
				// Insere os dados
				Yii::$app->db->createCommand()
					->insert(
						$this->tableName(), 
						$arrDados
					)
					->execute();

				$arrResult['INT_ID_EVENTO'] = Yii::$app->db->getLastInsertID();
			}

			$objTransaction->commit();

			return $arrResult;

		} catch (\Exception $objException) {
			$objTransaction->rollback();
			echo $objException;
		}
	}

	/**
	 * Método para consultar eventos.
	 * 
	 * @return boolean
	 * @throws Exception
	 */
	public function consultar($arrDados = array()) {
		try {
			if ( empty($arrDados['CLIENTE_INT_ID_CLIENTE']) )
				Yii::$app->session->setFlash('error', 'Parâmetros necessários!');
			
			$objQuery = new Query();

			$objQuery->select('EV.INT_ID_EVENTO, EV.STATUS_INT_ID_STATUS, EV.STR_NOME, EV.STR_PUBLICACAO, EV.INT_PAGAMENTO_ATIVO, EV.DAT_DATA_INICIO, EV.DAT_DATA_FINAL, EV.TIM_HORA_INICIO, EV.TIM_HORA_FINAL, SF.STR_GERENTE, SF.INT_ID_STAFF, TE.STR_DESCRICAO, ST.STR_DESCRICAO_STATUS')
					->from($this->tableName() . ' EV ')
					->join('INNER JOIN', 'STAFF SF', 'SF.EVENTO_INT_ID_EVENTO = EV.INT_ID_EVENTO')
					->join('INNER JOIN', 'TIPO_EVENTO TE', 'TE.INT_ID_TIPO_EVENTO = EV.TIPO_EVENTO_INT_ID_TIPO_EVENTO')
					->join('INNER JOIN', 'STATUS ST', 'ST.INT_ID_STATUS = EV.STATUS_INT_ID_STATUS')
					->where($arrDados);
			
			$objCommand = $objQuery->createCommand();
			$arrResult = $objCommand->queryAll();
			
			if ($arrResult)
				return $arrResult;
			else
				return FALSE;
		} catch (\Exception $objException) {
			echo $objException;
		}
	}
}
