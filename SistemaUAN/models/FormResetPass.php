<?php
 
namespace app\models;
use Yii;
use yii\base\model;
 
class FormResetPass extends model{
 
    public $email;
    public $password_hash;
    public $password_repeat;
    public $codVerificacao;
    public $recover;
     
    public function rules()
    {
        return [
            [['email', 'password_hash', 'password_repeat', 'codVerificacao', 'recover'], 'required', 'message' => 'Campo requerido'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Mínimo 5 e máximo 80 caracteres'],
            ['email', 'email', 'message' => 'Formato inválido'],
            ['password_hash', 'match', 'pattern' => "/^.{8,16}$/", 'message' => 'Mínimo 6 e máximo 16 caracteres'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 'message' => 'As senhas não correspondem'],
        ];
    }
}