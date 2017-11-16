<?php

namespace backend\modules\scenery\controllers;

use Yii;
use yeesoft\controllers\admin\BaseController;

/**
 * CountryController implements the CRUD actions for backend\modules\scenery\models\Country model.
 */
class CountryController extends BaseController 
{
    public $modelClass       = 'backend\modules\scenery\models\Country';
    public $modelSearchClass = 'backend\modules\scenery\models\CountrySearch';

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