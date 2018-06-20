<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato".
 *
 * @property int $id
 * @property int $numero
 * @property int $produto_id
 * @property int $unidade_id
 * @property string $marca
 * @property double $qtde
 * @property double $valoruni
 * @property int $fornecedor_id
 * @property string $data
 *
 * @property Produto $produto
 * @property Unidade $unidade
 * @property Fornecedor $fornecedor
 */
class Contrato extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contrato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero', 'produto_id', 'unidade_id', 'marca', 'qtde', 'valoruni', 'fornecedor_id', 'data'], 'required'],
            [['numero', 'produto_id', 'unidade_id', 'fornecedor_id'], 'integer'],
            [['qtde', 'valoruni'], 'number'],
            [['data'], 'safe'],
            [['marca'], 'string', 'max' => 45],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produto::className(), 'targetAttribute' => ['produto_id' => 'id']],
            [['unidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unidade::className(), 'targetAttribute' => ['unidade_id' => 'id']],
            [['fornecedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fornecedor::className(), 'targetAttribute' => ['fornecedor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'produto_id' => 'Produto',
            'unidade_id' => 'Unidade',
            'marca' => 'Marca',
            'qtde' => 'Quantidade',
            'valoruni' => 'Valor Unitário',
            'fornecedor_id' => 'Fornecedor',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidade()
    {
        return $this->hasOne(Unidade::className(), ['id' => 'unidade_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFornecedor()
    {
        return $this->hasOne(Fornecedor::className(), ['id' => 'fornecedor_id']);
    }
}
