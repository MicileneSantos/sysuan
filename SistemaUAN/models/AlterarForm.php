<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AlterarForm extends Model
{
    public $email;
    public $password_hash;
    public $password_repeat;
    public $codVerificacao;
    public $recover;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
         return [
            [['email', 'password_hash', 'password_repeat', 'codVerificacao','recover'], 'required', 'message' => 'Campo obrigatório'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 e máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato de email não válido'],
            ['password_hash', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 e máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'As senhas não coincidem'],
        ];
        
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'E-mail',
            'password_hash' => 'Senha',
        );
    }
}
