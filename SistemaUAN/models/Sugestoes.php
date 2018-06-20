<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sugestoes".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property string $verifyCode
 */
class Sugestoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sugestoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required', 'message' => 'Campo obrigatório'],
            [['body'], 'string'],
            ['email', 'email'],
            [['name', 'email', 'subject'], 'string', 'max' => 50],
            [['verifyCode'], 'string', 'max' => 40],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'Email'),
            'subject' => Yii::t('app', 'Assunto'),
            'body' => Yii::t('app', 'Mensagem'),
            'verifyCode' => Yii::t('app', 'Código de verificação'),
        ];
    }

}
