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
 *
 * @property ProdutoPrato[] $produtoPratos
 * @property Categoria $categoria
 * @property Unidade $unidade
 */
class Produto extends \yii\db\ActiveRecord
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
            [['descricao', 'categoria_id', 'unidade_id'], 'required', 'message' => 'Campo obrigatório'],
            [['descricao'], 'string', 'max' => 45],
            [['categoria_id','unidade_id'], 'integer'],
            ['descricao','unique'],
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
            'categoria_id' => 'Categoria',
            'unidade_id' => 'Unidade de medida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPratos()
    {
        return $this->hasMany(ProdutoPrato::className(), ['produto_id' => 'id']);
    }
    
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }
    
    public function getUnidade()
    {
        return $this->hasOne(Unidade::className(), ['id' => 'unidade_id']);
    }
}
