<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\helpers\Security;


/**
 * This is the model class for table "usuario".
 *
 * @property string $INT_ID_USUARIO
 * @property string $PERFIL_INT_ID_PERFIL
 * @property string $STR_NOME_COMPLETO
 * @property string $STR_EMAIL
 * @property string $STR_SENHA
 *
 * @property Perfil $pERFILINTIDPERFIL
 */
class Usuario extends ActiveRecord implements IdentityInterface
//class Usuario extends ActiveRecord implements IdentityInterface
{

public $id;
public $email;
public $password;
public $authKey;
public $accessToken;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'usuario';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INT_ID_USUARIO', 'PERFIL_INT_ID_PERFIL', 'STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_SENHA'], 'required'],
			[['INT_ID_USUARIO', 'PERFIL_INT_ID_PERFIL'], 'integer'],
			[['STR_NOME_COMPLETO', 'STR_EMAIL'], 'string', 'max' => 150],
			[['STR_SENHA'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'INT_ID_USUARIO' => 'Id Usuario',
			'PERFIL_INT_ID_PERFIL' => 'Perfil',
			'STR_NOME_COMPLETO' => 'Nome  Completo',
			'STR_EMAIL' => 'Email',
			'STR_SENHA' => 'Senha',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPERFILINTIDPERFIL()
	{
		return $this->hasOne(Perfil::className(), ['INT_ID_PERFIL' => 'PERFIL_INT_ID_PERFIL']);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id) {
		$user = self::find()
				->where([
					"INT_ID_USUARIO" => $id
				])
				->one();
		if (!count($user)) {
			return null;
		}
		return new static($user);
	}

	/**
	 * Finds user by username
	 *
	 * @param  string      $username
	 * @return static|null
	 */
	public static function findByEmail($email) {
		$user = self::find()
				->where([
					"STR_EMAIL" => $email
				])
				->one();
		if (!count($user)) {
			return null;
		}
		return new static($user);
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->auth_Key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * @inheritdoc
	 */
	/*
	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	} */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::findOne(['access_token' => $token]);
	}
   /**
	 * Finds user by password reset token
	 *
	 * @param  string      $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		$expire = \Yii::$app->params['user.passwordResetTokenExpire'];
		$parts = explode('_', $token);
		$timestamp = (int) end($parts);
		if ($timestamp + $expire < time()) {
			// token expired
			return null;
		}

		return static::findOne([
			'password_reset_token' => $token
		]);
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return boolean if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return static::findOne(['STR_SENHA' => $password] );
	}

 
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }
 
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }
 
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }
 
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
