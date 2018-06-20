<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "unidade".
 *
 * @property int $id
 * @property string $descricao
 * 
 * @property Produto $produto
 */
class Unidade extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unidade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required', 'message' => 'Campo obrigatório'],
            [['descricao'], 'string', 'max' => 45],
            ['descricao', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descrição',
        ];
    }
    
    public function getProduto()
    {
        return $this->hasMany(Produto::className(), ['unidade_id' => 'id']);
    }
    
}
