<?php

namespace backend\modules\scenery\controllers;

use Yii;
use yeesoft\controllers\admin\BaseController;
use yeesoft\models\User;

/**
 * LibrariesController implements the CRUD actions for backend\modules\scenery\models\Libraries model.
 */
class LibrariesController extends BaseController 
{
    public $modelClass       = 'backend\modules\scenery\models\Libraries';
    public $modelSearchClass = 'backend\modules\scenery\models\LibrariesSearch';

    protected function getRedirectPage($action, $model = null)
    {
        if (!User::hasPermission('editScenery') && $action == 'create') {
            return ['view', 'id' => $model>id];
        }
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