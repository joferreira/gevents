<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Transaction;

/**
 * This is the model class for table "log".
 *
 * @property string $INT_ID_LOG
 * @property string $CLIENTE_INT_ID_CLIENTE
 * @property string $STR_OCORRENCIA
 * @property string $DATA_LOG
 *
 * @property Cliente $cLIENTEINTIDCLIENTE
 */
class Log extends ActiveRecord
{
    const MENSAGEM_CADASTRO = 'Cadastro efetuado';
    const MENSAGEM_LOGIN = 'Login efetuado';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CLIENTE_INT_ID_CLIENTE', 'STR_OCORRENCIA'], 'required'],
            [['CLIENTE_INT_ID_CLIENTE'], 'integer'],
            [['DATA_LOG'], 'safe'],
            [['STR_OCORRENCIA'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'INT_ID_LOG' => 'Código Log',
            'CLIENTE_INT_ID_CLIENTE' => 'Código  Cliente',
            'STR_OCORRENCIA' => 'Ocorrência',
            'DATA_LOG' => 'Data do Log',
        ];
    }

    /**
     * Método para salvar o Log.
     * 
     * @param array Parâmetros do cliente
     */
    public function saveLog($arrDados = array()) {
        try {
            if (empty($arrDados))
                Yii::$app->session->setFlash('error', 'Parâmetros necessários!');

            $objTransaction = Yii::$app->db->beginTransaction();

            // Insere dados do aceite
            Yii::$app->db->createCommand()
                    ->insert(
                            $this->tableName(), [
                                'CLIENTE_INT_ID_CLIENTE' => $arrDados['CLIENTE_INT_ID_CLIENTE'], 
                                'STR_OCORRENCIA' => $arrDados['STR_OCORRENCIA']
                            ])->execute();

            $objTransaction->commit();
        } catch (Exception $objException) {
            $objTransaction->rollback();
            echo $objExcessao->getMessage();
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCLIENTEINTIDCLIENTE()
    {
        return $this->hasOne(Cliente::className(), ['INT_ID_CLIENTE' => 'CLIENTE_INT_ID_CLIENTE']);
    }
}
