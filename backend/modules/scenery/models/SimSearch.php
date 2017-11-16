<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Sim;

/**
 * SimTypeSearch represents the model behind the search form about `backend\modules\scenery\models\SimType`.
 */
class SimSearch extends Sim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_catsimulator'], 'integer'],
            [['catsimulator'], 'safe'],
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
        $query = Sim::find();

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
            'id_catsimulator' => $this->id_catsimulator,
        ]);

        $query->andFilterWhere(['like', 'catsimulator', $this->catsimulator]);

        return $dataProvider;
    }
}
