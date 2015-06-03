<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;
use yii\web\Session;

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
 * @property number $DEC_VALOR
 *
 * @property Evento $eVENTOINTIDEVENTO
 * @property VoucherPromocional[] $voucherPromocionals
 */
class Ingresso extends ActiveRecord
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
			[['DEC_VALOR'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
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
			'STR_INGRESSO_RESTRITO' => 'Seu ingresso é restrito ?',
			'STR_TAXA_SERVICO' => 'Quem paga a Taxa de Serviço ?',
			'DEC_VALOR'=> 'Valor do Ingresso',
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

	/**
	 * Método para salvar o evento.
	 * 
	 * @return integer Código do último ingresso
	 * @throws Exception
	 */
	public function saveIngresso($arrDados = array()) {
		try {
			
			$objTransaction = Yii::$app->db->beginTransaction();

			$arrDados['DAT_DATA_INICIO_VENDA'] = implode("-",array_reverse(explode("/",$arrDados['DAT_DATA_INICIO_VENDA'])));
			$arrDados['DAT_DATA_FINAL_VENDA'] = implode("-",array_reverse(explode("/",$arrDados['DAT_DATA_FINAL_VENDA'])));

			$arrDados['TIM_HORA_INICIO_VENDA'] = $arrDados['hora_inicio'].':'.$arrDados['minuto_inicio'].':00';
			$arrDados['TIM_HORA_FINAL_VENDA'] = $arrDados['hora_final'].':'.$arrDados['minuto_final'].':00';

			unset($arrDados['hora_inicio']);
			unset($arrDados['minuto_inicio']);
			unset($arrDados['hora_final']);
			unset($arrDados['minuto_final']);

			if( !empty($arrDados['INT_ID_INGRESSO']) ){
				
				Yii::$app->db->createCommand()
					->update(
						$this->tableName(), 
						$arrDados,
						[ 'INT_ID_INGRESSO' => $arrDados['INT_ID_INGRESSO'] ]
					)
					->execute();

				$arrResult['INT_ID_INGRESSO'] = $arrDados['INT_ID_INGRESSO'];

			} else {
				$arrDados['STATUS_INT_ID_STATUS'] = Status::STATUS_ATIVO ;
				// Insere os dados
				Yii::$app->db->createCommand()
					->insert(
						$this->tableName(), 
						$arrDados
					)
					->execute();

				$arrResult['INT_ID_INGRESSO'] = Yii::$app->db->getLastInsertID();
			}

			$objTransaction->commit();

			return $arrResult;

		} catch (\Exception $objException) {
			$objTransaction->rollback();
			echo $objException;
		}
	}

	/**
	 * Método para consultar ingressos.
	 * 
	 * @return boolean
	 * @throws Exception
	 */
	public function consultar($arrDados = array()) {
		try {
			if ( empty($arrDados['CLIENTE_INT_ID_CLIENTE']) )
				Yii::$app->session->setFlash('error', 'Parâmetros necessários!');
			
			$objQuery = new Query();

			$objQuery->select('IN.INT_ID_INGRESSO, IN.EVENTO_INT_ID_EVENTO, IN.STR_DESCRICAO, IN.DAT_DATA_INICIO_VENDA, IN.TIM_HORA_INICIO_VENDA, IN.DAT_DATA_FINAL_VENDA, IN.TIM_HORA_FINAL_VENDA, IN.INT_QUANTIDADE, IN.STR_INGRESSO_RESTRITO, IN.STR_TAXA_SERVICO, IN.INT_QUANTIDADE_MAXIMA_VENDA_PARTICIPANTE')
					->from($this->tableName() . ' IN ')
					//->join('INNER JOIN', 'EVENTO EV', 'IN.EVENTO_INT_ID_EVENTO = EV.INT_ID_EVENTO')
					->join('INNER JOIN', 'STAFF SF', 'SF.EVENTO_INT_ID_EVENTO = IN.EVENTO_INT_ID_EVENTO')
					//->join('INNER JOIN', 'TIPO_EVENTO TE', 'TE.INT_ID_TIPO_EVENTO = EV.TIPO_EVENTO_INT_ID_TIPO_EVENTO')
					//->join('INNER JOIN', 'STATUS ST', 'ST.INT_ID_STATUS = EV.STATUS_INT_ID_STATUS')
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
