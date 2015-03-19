<?php
namespace frontend\models;

use common\models\Cliente;
use yii\base\Model;
use Yii;

/**
 * Cadastro form
 */
class CadastroForm extends Model
{
	public $STR_NOME_COMPLETO;
	public $STR_EMAIL;
	public $STR_SENHA;
	public $STR_SENHA_CONFIRME;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{

		return [
			[['STR_EMAIL', 'STR_NOME_COMPLETO', 'STR_SENHA'], 'required', 'on'=>'register'],
			[['STR_EMAIL'], 'string', 'max' => 150],
			[['STR_SENHA'], 'string', 'min' => 8, 'max' => 10],
			[['STR_NOME_COMPLETO'], 'filter', 'filter' => 'trim'],
			['STR_EMAIL', 'email'],
			[['STR_SENHA_CONFIRME'], 'compare', 'compareValue' => 'STR_SENHA', 'on'=>'register'],
			//['STR_SENHA', 'compare', 'compareAttribute' => 'confirmeSTR_SENHA', 'operator' => '==']
		];
	}
    public function scenarios()
    {
		$scenarios = parent::scenarios();
		$scenarios['login'] = ['STR_EMAIL', 'STR_SENHA'];
		$scenarios['register'] = ['STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_SENHA','STR_SENHA_CONFIRME'];
		return $scenarios;	
    }

	/*
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('service_id, review_date, rating, review', 'required'),
            array('email', 'email'),
     
            array('email', 'checkUser','message'=>'Test message for email validation'),
            array('user_id', 'checkUser','message'=>'Test message for user_id validation'),
     
            array('review', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('service_id, user_id,email', 'safe', 'on'=>'search'),
        );
    }
    */
    public function checkUser($attribute,$params)
    {
        switch($attribute){
            case "email":
                $models = ServiceReviews::model()->findAllByAttributes(array('email' =>$this->email,'service_id'=>$this->service_id));
                if(count($models)>0){
                     $this->addError($attribute, $params['message']);
                }
            break;
            case "user_id":
                if(Yii::app()->user->isGuest){
                    $models = ServiceReviews::model()->findAllByAttributes(array('user_id' =>Yii::app()->user->id,'service_id'=>$this->service_id));
                    if(count($models)>0){
                         $this->addError($attribute, $params['message']);
                    }
                }
            break;
        }
     
    }

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'nome' => 'Nome Completo',
			'email' => 'Email',
			'senha' => 'Senha',
			'senha_repeat' => 'Confirmar Senha',
		];
	}

}
