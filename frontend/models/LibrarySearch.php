<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Libraries;

/**
 * LibrarySearch represents the model behind the search form about `backend\modules\scenery\models\Libraries`.
 */
class LibrarySearch extends Libraries
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'created_by', 'updated_by', 'ranking', 'status'], 'integer'],
            [['description', 'author', 'videoUrl', 'url', 'name'], 'safe'],
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
        $query = Libraries::find()->where(['status' => Libraries::STATUS_ACTIVE]);       
       

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'ranking' => $this->ranking,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'videoUrl', $this->videoUrl])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
