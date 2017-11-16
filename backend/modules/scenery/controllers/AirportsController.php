<?php

namespace backend\modules\scenery\controllers;

use Yii;
use yeesoft\controllers\admin\BaseController;

/**
 * AirportsController implements the CRUD actions for backend\modules\scenery\models\Airports model.
 */
class AirportsController extends BaseController 
{
    public $modelClass       = 'backend\modules\scenery\models\Airports';
    public $modelSearchClass = 'backend\modules\scenery\models\AirportsSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->ID];
                break;
            case 'create':
                return ['update', 'id' => $model->ID];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}