<?php

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
 */
class User extends ActiveRecord implements IdentityInterface
{
    
     /**
     * @inheritdoc
     */
    public $password_repeat;
    
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
            [['nome','cpf','email','password_hash','role'], 'required', 'message'=> 'Campo obrigatório'],
            [['role'], 'required', 'message' => 'Campo obrigatório'],
            [['nome', 'rua'], 'string','min' => 3, 'max' => 50],
            ['cpf','string'],
            [['complemento', 'bairro', 'cidade', 'estado', 'email'], 'string', 'max' => 30],
            ['telefone', 'string'],
            [['password_hash'], 'string', 'max' => 250],
            [['role','numero'],'number','integerOnly'=>true],
            ['email','email'],
            ['email','unique'],
            ['cpf','unique'],
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
            'password_repeat' => 'Repita a senha',
            'isAtivo' => 'Status (clique para alterar):',

        ];
    }
    
    
    public function getAuthKey() {
        return null;
    }

    public function getId() {
        return $this->getPrimaryKey();
    }

    public function validateAuthKey($authKey){
        return null;
    }

    public static function findIdentity($id){
        return static::findOne(['id' => $id]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }
    
    public function validatePassword($password)
    {
       return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
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

