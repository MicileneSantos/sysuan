<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefeicaoPrato;

/**
 * RefeicaoPratoSearch represents the model behind the search form of `app\models\RefeicaoPrato`.
 */
class RefeicaoPratoSearch extends RefeicaoPrato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'prato_id', 'refeicao_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = RefeicaoPrato::find();

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
            'refeicao_id' => $this->refeicao_id,
        ]);

        return $dataProvider;
    }
}
