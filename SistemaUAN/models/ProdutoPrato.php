<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "produto_prato".
 *
 * @property int $id
 * @property int $prato_id
 * @property int $produto_id
 * @property double $percapita
 *
 * @property Prato $prato
 * @property Produto $produto
 */
class ProdutoPrato extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto_prato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prato_id', 'produto_id'], 'integer'],
            [['percapita'], 'number'],
            [['prato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prato::className(), 'targetAttribute' => ['prato_id' => 'id']],
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
            'prato_id' => 'Prato',
            'produto_id' => 'Ingredientes',
            'percapita' => 'Per capita'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrato()
    {
        return $this->hasOne(Prato::className(), ['id' => 'prato_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produto::className(), ['id' => 'produto_id']);
    }
}
