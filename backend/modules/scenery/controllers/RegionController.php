<?php

namespace backend\modules\scenery\controllers;

use Yii;
use yeesoft\controllers\admin\BaseController;

/**
 * RegionController implements the CRUD actions for backend\modules\scenery\models\Region model.
 */
class RegionController extends BaseController 
{
    public $modelClass       = 'backend\modules\scenery\models\Region';
    public $modelSearchClass = 'backend\modules\scenery\models\RegionSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id_icao_region];
                break;
            case 'create':
                return ['update', 'id' => $model->id_icao_region];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}