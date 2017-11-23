<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Airports;

/**
 * AirportsSearch represents the model behind the search form about `backend\modules\scenery\models\Airports`.
 */
class AirportsSearch extends Airports
{
    public $country_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PrimaryID', 'Elevation'], 'integer'],
            [['Name', 'ICAO', 'country_name'], 'safe'],
            [['Latitude', 'Longitude'], 'number'],
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
        //$query = Airports::find();
        //SELECT * FROM `airports` INNER JOIN `icao_country` ON SUBSTR(`airports`.`ICAO`, 3) = `icao_country`.`icao_country` 
        
        $query = Airports::find()->select('*')->from('airports')
                ->innerJoin('icao_country', 'icao_country = SUBSTR(ICAO, 1,2)');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            /*'sort' => [
                'defaultOrder' => [
                    'ID' => SORT_DESC,
                ],
            ],*/
        ]);
        
        $dataProvider->sort->attributes['country_name'] = [
            'asc' => ['country_name' => SORT_ASC],
            'desc' => ['country_name' => SORT_DESC],
        ];
        
        //print_r($dataProvider);
        //die();

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID' => $this->ID,
            'PrimaryID' => $this->PrimaryID,
            'Latitude' => $this->Latitude,
            'Longitude' => $this->Longitude,
            'Elevation' => $this->Elevation,
            'country_name' => $this->country_name,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'ICAO', $this->ICAO]);

        return $dataProvider;
    }
}
