<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prato_cardapio".
 *
 * @property int $id
 * @property int $prato_id
 * @property int $cardapio_id
 *
 * @property Prato $prato
 * @property Cardapio $cardapio
 */
class PratoCardapio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prato_cardapio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prato_id', 'cardapio_id'], 'integer'],
            [['prato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prato::className(), 'targetAttribute' => ['prato_id' => 'id']],
            [['cardapio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cardapio::className(), 'targetAttribute' => ['cardapio_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prato_id' => 'Pratos',
            'cardapio_id' => 'Cardapio',
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
    public function getCardapio()
    {
        return $this->hasOne(Cardapio::className(), ['id' => 'cardapio_id']);
    }
}
