<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estoque".
 *
 * @property int $id
 * @property int $produto_id
 * @property int $qtde
 * @property string $tipolanc
 * @property string $data
 *
 * @property Produto $produto
 */
class Estoque extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estoque';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produto_id', 'qtde', 'tipolanc'], 'required', 'message' => 'Campo obrigatório'],
            [['produto_id', 'qtde'], 'integer'],
            [['data'], 'safe'],
            [['tipolanc'], 'string', 'max' => 10],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produto_id' => 'Produto',
            'qtde' => 'Quantidade',
            'tipolanc' => 'Lançamento',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_id']);
    }
}
