<?php

namespace backend\modules\scenery\controllers;

use Yii;
use yeesoft\controllers\admin\BaseController;

/**
 * RunwaysController implements the CRUD actions for backend\modules\scenery\models\Runways model.
 */
class RunwaysController extends BaseController 
{
    public $modelClass       = 'backend\modules\scenery\models\Runways';
    public $modelSearchClass = 'backend\modules\scenery\models\RunwaysSearch';

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}