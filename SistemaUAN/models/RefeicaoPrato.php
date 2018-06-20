<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "refeicao_prato".
 *
 * @property int $id
 * @property int $prato_id
 * @property int $refeicao_id
 *
 * @property Prato $prato
 * @property Refeicao $refeicao
 */
class RefeicaoPrato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refeicao_prato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prato_id', 'refeicao_id'], 'integer'],
            [['prato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prato::className(), 'targetAttribute' => ['prato_id' => 'id']],
            [['refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['refeicao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prato_id' => 'Prato ID',
            'refeicao_id' => 'Refeicao ID',
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
    public function getRefeicao()
    {
        return $this->hasOne(Refeicao::className(), ['id' => 'refeicao_id']);
    }
}
