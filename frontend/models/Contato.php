<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;
use yii\db\Query;
use app\models\Exception;

/**
 * Classe Model da tabela "CONTATO".
 *
 * @property integer $INT_ID_CONTATO
 * @property integer $CLIENTE_INT_ID_CLIENTE
 * @property string $STR_MENSAGEM
 * @property string $STR_RESPOSTA
 * @property string $STR_TIPO_CONTATO
 * @property string $DAT_DATA_CONTATO
 *
 * As seguintes são as relações modelo disponíveis:
 * @property CLIENTE $cLIENTEINTIDCLIENTE
 */
class Contato extends ActiveRecord
{
    /**
	 * Método para buscar o nome da tabela.
	 * 
	 * @return Nome da tabela
	 */
    public static function tableName()
    {
        return 'CONTATO';
    }

    /**
	 * Método para validação de atributos.
	 * 
	 * @return array regras de validação para os atributos do modelo.
	 */
    public function rules()
    {
        return [
            [['STR_MENSAGEM'], 'required'],
            [['CLIENTE_INT_ID_CLIENTE'], 'integer'],
            [['STR_MENSAGEM'], 'string'],
            [['DAT_DATA_CONTATO'], 'safe'],
            [['STR_RESPOSTA', 'STR_TIPO_CONTATO'], 'string', 'max' => 1]
        ];
    }
	
	/**
	 * Método para consultar contatos.
	 * 
	 * @return boolean
	 * @throws Exception
	 */
	public function consultar() {
		try {
			if ( empty($this->CLIENTE_INT_ID_CLIENTE) )
				Yii::$app->session->setFlash('error', 'Parâmetros necessários!');
			
			$objQuery = new Query();
			
			$objQuery->select('CO.INT_ID_CONTATO, CO.CLIENTE_INT_ID_CLIENTE, CO.STR_MENSAGEM, CO.STR_VISUALIZADO, CO.DAT_DATA_CONTATO, '
					. 'CL.STR_NOME_COMPLETO')
					->from($this->tableName() . ' CO ')
					->join('INNER JOIN', 'CLIENTE CL', 'CO.CLIENTE_INT_ID_CLIENTE = CL.INT_ID_CLIENTE')
					->where(['CLIENTE_INT_ID_CLIENTE' => $this->CLIENTE_INT_ID_CLIENTE]);
			
			$objCommand = $objQuery->createCommand();
			$arrResult = $objCommand->queryAll();
			
			if ($arrResult)
				return $arrResult;
			else
				return FALSE;
		} catch (Exception $objException) {
			throw $objException;
		}
	}


	/**
	 * Método para salvar o contato.
	 * 
	 * @return integer Código do último contato
	 * @throws Exception
	 */
	public function saveContato() {
		try {
			if (empty($this->STR_MENSAGEM))
				Yii::$app->session->setFlash('error', 'Parâmetros necessários!');
			
			if (empty($this->CLIENTE_INT_ID_CLIENTE))
				Yii::$app->session->setFlash('error', 'Parâmetros necessários!');
			
			$objTransaction = Yii::$app->db->beginTransaction();
			
			// Insere dados contato
			Yii::$app->db->createCommand()
					->insert(
							$this->tableName(), [
						'STR_MENSAGEM' => $this->STR_MENSAGEM,
						'CLIENTE_INT_ID_CLIENTE' => $this->CLIENTE_INT_ID_CLIENTE
					])->execute();

			$intMaxIdContato = Yii::$app->db->getLastInsertID();

			$objTransaction->commit();
			
			return $intMaxIdContato;
		} catch (Exception $objException) {
			$objTransaction->rollback();
			throw $objException;
		}
	}

	/**
	 * Método de retorno de campos para validação.
	 * 
	 * @return string
	 */
	public function scenarios() {
		$objScenarios = parent::scenarios();
		$objScenarios['contato'] = ['STR_MENSAGEM', 'CLIENTE_INT_ID_CLIENTE'];
		
		return $objScenarios;
	}

    /**
	 * @return array Costumização de labels (name=>label)
	 */
    public function attributeLabels()
    {
        return [
            'INT_ID_CONTATO' => 'Código de Contato',
            'CLIENTE_INT_ID_CLIENTE' => 'Código do Cliente',
            'STR_MENSAGEM' => 'Mensagem, dúvida ou pergunta',
            'STR_RESPOSTA' => 'Resposta',
            'STR_TIPO_CONTATO' => 'Tipo de Contato',
            'DAT_DATA_CONTATO' => 'Data de Contato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLIENTEINTIDCLIENTE()
    {
        return $this->hasOne(CLIENTE::className(), ['INT_ID_CLIENTE' => 'CLIENTE_INT_ID_CLIENTE']);
    }
}
