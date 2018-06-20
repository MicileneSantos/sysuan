<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contrato;

/**
 * ContratoSearch represents the model behind the search form of `app\models\Contrato`.
 */
class ContratoSearch extends Contrato
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numero', 'produto_id', 'unidade_id', 'fornecedor_id'], 'integer'],
            [['marca', 'data'], 'safe'],
            [['qtde', 'valoruni'], 'number'],
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
        $query = Contrato::find();

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
            'numero' => $this->numero,
            'produto_id' => $this->produto_id,
            'unidade_id' => $this->unidade_id,
            'qtde' => $this->qtde,
            'valoruni' => $this->valoruni,
            'fornecedor_id' => $this->fornecedor_id,
            'data' => $this->data,
        ]);

        $query->andFilterWhere(['like', 'marca', $this->marca]);

        return $dataProvider;
    }
}
