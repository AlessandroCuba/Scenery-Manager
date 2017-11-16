<?php

namespace backend\modules\scenery\widgets;

use yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

use nemmo\attachments\models\File;


class ImagesScenery extends Widget 
{
    public $id;
            
    public function init(){
        parent::init();
    }
    
    public function run(){
        
       $data = new ActiveDataProvider([
            'query' => File::find()->andWhere(['itemId' => $this->id])->asArray(),
        ]);
        
        return $this->render('imagesListView', [
                'data' => $data,
        ]);
    }
}