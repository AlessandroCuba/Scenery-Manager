<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Scenery;

/**
 * ScenerySearch represents the model behind the search form about `backend\modules\scenery\models\Scenery`.
 */
class ScenerySearch extends Scenery
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'catesim', 'ranking', 'status'], 'integer'],
            [['icao', 'creator', 'description', 'url_video', 'url_download', 'author_id', 'updater_id'], 'safe'],
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
        $query = Scenery::find();

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
            'catesim' => $this->catesim,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'ranking' => $this->ranking,
            'status' => $this->status,
            'author_id' => $this->author_id, 
            'updater_id' => $this->updater_id,
        ]);

        $query->andFilterWhere(['like', 'icao', $this->icao])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'url_video', $this->url_video])
            ->andFilterWhere(['like', 'url_download', $this->url_download]);

        return $dataProvider;
    }
}
