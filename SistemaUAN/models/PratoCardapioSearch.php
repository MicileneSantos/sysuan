<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PratoCardapio;

/**
 * PratoCardapioSearch represents the model behind the search form of `app\models\PratoCardapio`.
 */
class PratoCardapioSearch extends PratoCardapio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'prato_id', 'cardapio_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PratoCardapio::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'prato_id' => $this->prato_id,
            'cardapio_id' => $this->cardapio_id,
        ]);

        return $dataProvider;
    }
}
