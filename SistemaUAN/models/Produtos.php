<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string $descricao
 * @property int $categoria_id
 * @property int $unidade_id
 */
class Produtos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'categoria_id', 'unidade_id'], 'required'],
            [['categoria_id', 'unidade_id'], 'integer'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'categoria_id' => 'Categoria ID',
            'unidade_id' => 'Unidade ID',
        ];
    }
}
