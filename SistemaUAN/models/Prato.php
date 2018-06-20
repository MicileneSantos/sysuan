<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prato".
 *
 * @property int $id
 * @property string $descricao
 *
 * @property PratoCardapio[] $pratoCardapios
 * @property ProdutoPrato[] $produtoPratos
 */
class Prato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prato';
    }

    use \mootensai\relation\RelationTrait;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'],  'required', 'message' => 'Campo obrigatório'],
            [['descricao'], 'string', 'max' => 45],
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
            'descricao' => 'Descrição',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPratoCardapios()
    {
        return $this->hasMany(PratoCardapio::className(), ['prato_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoPratos()
    {
        return $this->hasMany(ProdutoPrato::className(), ['prato_id' => 'id']);
    }
}
