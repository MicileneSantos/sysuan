<?php
 
namespace app\models;
use Yii;
use yii\base\Model;
 
class ResetPassForm extends Model {
    public $email;
    public $password_hash;
    public $password_repeat;
    public $codVerificacao;
    public $recover;
     
    public function rules()
    {
        return [
            [['email', 'password_hash', 'password_repeat', 'codVerificacao', 'recover'], 
                'required', 'message' => 'Campo obrigatório.'],
            [['email'], 'string', 'max' => 30],
            ['email', 'email', 'message' => 'Formato não válido'],
            [['password_hash'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password_hash', 
                'message' => 'As senhas não coincidem.'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail',
            'password_hash' => 'Senha atual',
            'password_hash' => 'Nova senha',
            'password_repeat' => 'Confirmar nova senha',
            'codVerificacao' => 'Código de verificação',
            
        ];
    }
}