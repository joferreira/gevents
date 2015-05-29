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

			$arrDados['TIM_HORA_INICIO'] = $arrDados['hora_inicio'].':'.$arrDados['minuto_inicio'].':00';
			$arrDados['TIM_HORA_FINAL'] = $arrDados['hora_final'].':'.$arrDados['minuto_final'].':00';

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
}
