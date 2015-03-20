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
			[['STR_SENHA'], 'string', 'min' => 8, 'max' => 10 , 'on'=>'register'],
			[['STR_NOME_COMPLETO'], 'filter', 'filter' => 'trim'],
			['STR_EMAIL', 'email'],
			['STR_EMAIL', 'checkEmail', 'on'=>'register' ],
			[['STR_SENHA_CONFIRME'], 'compare', 'compareValue' => 'STR_SENHA', 'on'=>'register']
		];
	}
    public function scenarios()
    {
		$scenarios = parent::scenarios();
		$scenarios['login'] = ['STR_EMAIL', 'STR_SENHA'];
		$scenarios['register'] = ['STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_SENHA','STR_SENHA_CONFIRME'];
		return $scenarios;	
    }

    public function checkEmail($attribute,$params)
	{
	   // $models = ServiceReviews::model()->findAllByAttributes(array('STR_EMAIL' =>$this->STR_EMAIL));
	   // if(count($models)>0){
	        $this->addError($attribute, 'You have already submitted review for this item');
	    //}
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'STR_NOME_COMPLETO' => 'Nome Completo',
			'STR_EMAIL' => 'Email',
			'STR_SENHA' => 'Senha',
			'STR_SENHA_CONFIRME' => 'Confirmar Senha',
		];
	}

}
