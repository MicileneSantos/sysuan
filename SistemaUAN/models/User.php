<?php

/******************************************************************
 * SYSUAN - SISTEMA  DE GERENCIAMENTO DA UNIDADE DE ALIMENTAÇÃO
 * E NUTRIÇÃO - IFNMG JANUÁRIA
 * 
 * Trabalho de Conclusão de Curso
 * Tecnologia em Análise e Desenvolvimento de Sistemas.
 *
 * Desenvolvido pela acadêmica: Micilene Bispo Santos.
 * Orientadora: Cleiane Gonçalves Oliveira.
 *
 /*****************************************************************/

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf
 * @property string $email
 * @property string $telefone
 * @property string $rua
 * @property int $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property int $role
 * @property string $password_hash
 * @property string $codVerificacao
 * @property int @isAtivo
 * @property string $password_reset_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public $password_hash_repeat;
    
    public static function tableName()
    {
        return 'usuarios';
    }
    
     /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome','cpf','email','password_hash','role','password_hash_repeat'], 'required', 'message'=> 'Campo obrigatório'],
            [['role'], 'required', 'message' => 'Campo obrigatório'],
            [['nome', 'email'], 'trim'],
            [['nome', 'rua'], 'string','min' => 3, 'max' => 50],
            ['cpf','string'],
            [['complemento', 'bairro', 'cidade', 'estado', 'email'], 'string', 'max' => 40],
            ['telefone', 'string'],
            [['password_hash'], 'string', 'max' => 250],
            [['role','numero'],'number','integerOnly'=>true],
            ['email','email'],
            ['email','unique'],
            ['cpf','unique'],
            ['password_hash_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'As senhas não correspondem.'],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Usuario',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'E-mail',
            'telefone' => 'Telefone',
            'rua' => 'Rua',
            'numero' => 'Número',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'role' => 'Perfil',
            'password_hash' => 'Senha',
            'password_hash_repeat' => 'Repita a Senha',
            'isAtivo' => 'Status',

        ];
    }
    
     public function getAuthKey(){
        return null;
    }

    public function getId(){
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey){
        return null;
    }

    public static function findIdentity($id){
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        return null;
    }
    
    public function validatePassword($password){
       return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
     /**
     * Generates "remember me" authentication key
     */
    /*public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }*/

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    
    
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'isAtivo' => self::STATUS_ACTIVE]);
    }
    
    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'isAtivo' => 1,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
    
     public function generateAccountActivationToken()
    {
        $this->account_activation_token = Yii::$app->security->generateRandomString() . '_' . time();
    }


    public function removeAccountActivationToken()
    {
        $this->account_activation_token = null;
    }
    
    public static function isUserAdmin($id)
    {
        if (User::findOne(['id' => $id, 'role' => 1])){
            return true;
        } else {

            return false;
        }
    }
    public static function isUserNutricionista($id)
    {
        if (User::findOne(['id' => $id, 'role' => 2])){
            return true;
        } else {
            return false;
        }
    }
    public static function isUserDiscente($id)
    {
        if (User::findOne(['id' => $id, 'role' => 3])){
            return true;
        } else {
            return false;
        }
    }
}

