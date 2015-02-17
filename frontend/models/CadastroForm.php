<?php
namespace frontend\models;

use frontend\models\Cliente;
use yii\base\Model;
use Yii;

/**
 * Cadastro form
 */
class CadastroForm extends Model
{
	public $nome;
	public $email;
	public $senha;
	public $confirmeSenha;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['nome', 'filter', 'filter' => 'trim'],
			['nome', 'required'],
			['nome', 'unique', 'targetClass' => 'frontend\models\Cliente', 'message' => 'Teste'],
			['nome', 'string', 'min' => 6, 'max' => 255],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'unique', 'targetClass' => 'frontend\models\Cliente', 'message' => 'This email address has already been taken.'],

			['senha', 'required'],
			['confirmeSenha', 'required'],
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */
	public function signup()
	{
		if ($this->validate()) {
			$user = new User();
			$user->username = $this->username;
			$user->email = $this->email;
			$user->setPassword($this->password);
			$user->generateAuthKey();
			if ($user->save()) {
				return $user;
			}
		}

		return null;
	}
}
