<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cardapio".
 *
 * @property int $id
 * @property string $descricao
 * @property int $refeicao_id
 *
 * @property Refeicao $refeicao
 * @property PratoCardapio[] $pratoCardapios
 */
class Cardapio extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cardapio';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao'], 'required', 'message' => 'Campo obrigatório'],
            [['descricao'], 'string'],
            //[['refeicao_id'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['refeicao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao'
            //'refeicao_id' => 'Refeição',
            //'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefeicao()
    {
        //return $this->hasOne(Refeicao::className(), ['id' => 'refeicao_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPratoCardapios()
    {
        return $this->hasMany(PratoCardapio::className(), ['cardapio_id' => 'id']);
    }
}
