<?php

namespace backend\modules\scenery\widgets\Portafolio;

use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\models\Libraries;
use yii\base\Widget;
//use yeesoft\models\User;
//use yeesoft\widgets\DashboardWidget;

class Portafolio extends Widget
{
    public $limit;
    public $layout = 'view';
    

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $query = Scenery::find()->select(['id', 'creator','catesim' ,'icao'])->where(['status' => Scenery::STATUS_ACTIVE])
                                ->orderBy(['created_at' => SORT_DESC])->limit($this->limit)->all();
        if($query){
            return $this->render($this->layout, [
                    'items' => $query,
                ]);
        }
    }
}
