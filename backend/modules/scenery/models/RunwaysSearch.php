<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Runways;

/**
 * RunwaysSearch represents the model behind the search form about `backend\modules\scenery\models\Runways`.
 */
class RunwaysSearch extends Runways
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'AirportID', 'Length', 'Width', 'Elevation'], 'integer'],
            [['Ident', 'Surface'], 'safe'],
            [['TrueHeading', 'Latitude', 'Longtitude'], 'number'],
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
        $query = Runways::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'AirportID' => $this->AirportID,
            'TrueHeading' => $this->TrueHeading,
            'Length' => $this->Length,
            'Width' => $this->Width,
            'Latitude' => $this->Latitude,
            'Longtitude' => $this->Longtitude,
            'Elevation' => $this->Elevation,
        ]);

        $query->andFilterWhere(['like', 'Ident', $this->Ident])
            ->andFilterWhere(['like', 'Surface', $this->Surface]);

        return $dataProvider;
    }
}
