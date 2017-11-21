<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\models\Country;
use backend\modules\scenery\models\Region;

/**
 * ScenerySearch represents the model behind the search form about `backend\modules\scenery\models\Scenery`.
 */
class ScenerySearch extends Scenery
{
    public $icao_country;
    public $region;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'catesim', 'created_at', 'updater_id', 'updated_at', 'ranking', 'status'], 'integer'],
            [['icao', 'creator', 'catesim', 'region', 'icao_country'], 'safe'],
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
        $queryRegion = Region::find()->select('id_icao_region');
        $queryCountry = Country::find()->select('icao_country');
        $query = Scenery::find()->where(['status' => Scenery::STATUS_ACTIVE]);
        
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['icao'=>SORT_ASC]]
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
            'author_id' => $this->author_id,
            'catesim' => $this->catesim,
            'ranking' => $this->ranking,
        ]);

        $query->andFilterWhere(['like', 'icao', $this->icao]);
        
        /* ======= Filter Country or Region ==================*/        
        if($this->region){        
            $queryRegion->andWhere(['id_icao_region' => $this->region]);
        }
        if($this->icao_country){
            $queryCountry->andWhere(['icao_country' => $this->icao_country])
                         ->andWhere(['IN', 'regionId', $queryRegion]);
        }
        $queryCountry->andWhere(['IN', 'regionId', $queryRegion]);
        
        
        $query->andFilterWhere(['IN', 'SUBSTRING(`icao`, 1, 2)', $queryCountry]);
                
        return $dataProvider;
    }
}
