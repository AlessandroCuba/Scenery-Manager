<?php
namespace frontend\controllers;

use yii;
use yii\data\ActiveDataProvider;
use backend\modules\scenery\models\Region;

class RegionController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = 'view';
        
        $queryRegion = Region::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $queryRegion,
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
