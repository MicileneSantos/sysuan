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

    public static function ingredienteSession($items = [])
    {
        $session = Yii::$app->session;
        if (!$session->has('ingredientes'))
            $session->set('ingredientes', $items);

        return $session->get('ingredientes');
    }

    public function afterSave ($insert, $changedAttributes)
    {
        $this->salvaIngredientes ();
        Yii::$app->session->remove ('ingredientes');

        return parent::afterSave ($insert, $changedAttributes);
    }

    private function salvaIngredientes()
    {
        $ingredienteModel = $this->getProdutoPratos()->modelClass;
        $ingredientes = self::ingredienteSession ();
        if (!empty($ingredientes)) {
            $ingredienteModel::deleteAll(['prato_id' => $this->id]);
            foreach ($ingredientes as $ingrediente) {
                $model = new $ingredienteModel;
                $model->setAttributes(array_merge ($ingrediente, [
                    'prato_id' => $this->id
                ]));
                $model->save();
            }
        }
    }

    public function carregaIngredientes()
    {
        if (!Yii::$app->session->has('ingredientes')) {
            $items = [];
            $ingredientes = $this->produtoPratos;

            if (!empty($ingredientes)) {

                foreach ($ingredientes as $key => $ingrediente) {
                    $prod = $ingrediente->produto;
                    $id = $ingrediente->produto_id;
                    $items[$id]['descricao'] = (!empty($prod)) ? $prod->descricao : null;
                    $items[$id]['percapita'] = $ingrediente->percapita;
                    $items[$id]['produto_id'] = $id;
                }

                self::ingredienteSession($items);
            }
        }
    }
}
