<?php

namespace backend\modules\scenery\controllers;

use Yii;

use yeesoft\controllers\admin\BaseController;
use yeesoft\models\User;

/**
 * SceneryController implements the CRUD actions for backend\modules\scenery\models\Scenery model.
 */
class SceneryController extends BaseController 
{
    public $modelClass              = 'backend\modules\scenery\models\Scenery';
    public $modelSearchClass        = 'backend\modules\scenery\models\ScenerySearch';
    public $modelLibraryClass       = 'backend\modules\scenery\models\Libraries';
    public $modelLibrarySearchClass = 'backend\modules\scenery\models\LibrarySearch';
    
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
