<?php

namespace app\models;
use yii\base\Model;

class RecoverPassForm extends Model {
    
    public $email;
     
    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Campo obrigatório.'],
            [['email'], 'string', 'max' => 30],
            ['email', 'email', 'message' => 'Formato não válido'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail:',
        ];
    }
}
