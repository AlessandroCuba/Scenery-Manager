<?php

namespace backend\modules\scenery\widgets;

use backend\modules\scenery\models\Scenery;
use yii\base\Widget;
//use yeesoft\models\User;
//use yeesoft\widgets\DashboardWidget;
use Yii;

class Portafolio extends Widget
{

    /**
     * Most recent comments limit
     */
    public $limit = 9;  //only 3, 6, 9, 12
    public $layout = 'view';
    //public $commentTemplate = 'comment';

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        if($this->limit < 12){
            $portafolioList = Scenery::find()
                ->where(['status' => 10])
                ->orderBy(['created_at' => SORT_DESC])
                ->limit($this->limit)
                ->all();
            
            if(!$portafolioList){
                echo '<h2>Sin Resultados</h2>';
            }
            
            return $this->render($this->layout, [
                'portafolioList' => $portafolioList,
            ]);
        }
        else{
            echo 'Limite muy grande';
        }
    }
}
