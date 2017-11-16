<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Surface;

/**
 * SurfaceSearch represents the model behind the search form about `backend\modules\scenery\models\Surface`.
 */
class SurfaceSearch extends Surface
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SurfaceType', 'Description'], 'safe'],
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
        $query = Surface::find();

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
        $query->andFilterWhere(['like', 'SurfaceType', $this->SurfaceType])
            ->andFilterWhere(['like', 'Description', $this->Description]);

        return $dataProvider;
    }
}
