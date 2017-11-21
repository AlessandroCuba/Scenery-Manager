<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yeesoft\grid\GridView;
use yeesoft\grid\GridQuickLinks;
use yeesoft\helpers\Html;
use yeesoft\grid\GridPageSize;
use yii2mod\rating\StarRating;

/* Models */
use backend\modules\scenery\models\Scenery;
use yeesoft\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\scenery\models\ScenerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sceneries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scenery-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['scenery/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /*Uncomment this to activate GridQuickLinks */
                    echo GridQuickLinks::widget([
                        'model' => Scenery::className(),
                        'searchModel' => $searchModel,
                    ])
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'scenery-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'scenery-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'scenery-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'scenery-grid',
                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => 'scenery',
                        'title' => function(Scenery $model) {
                            return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                    ],
                    'icao',
                    //'creator',
                    //'image_1',
                    // 'image_2',
                    // 'image_3',
                    // 'description',
                    [
                        'label' => 'Simulator',
                        'attribute' => 'catesim',
                        'value' =>  'simulator.catsimulator',
                        'filter' => Scenery::getSimList(),
                    ],
                    // 'url_video:url',
                    // 'url_download:url',
                    [
                        'attribute' => 'author_id',
                        'filter' => User::getUsersList(),
                        'value' => function (Scenery $model) {
                            return Html::a($model->author->username,
                                ['/user/default/update', 'id' => $model->author_id],
                                ['data-pjax' => 0]);
                        },
                        'format' => 'raw',
                        'visible' => User::hasPermission('viewUsers'),
                        'options' => ['style' => 'width:180px'],
                    ],
                    [
                        'attribute' => 'created_at',
                        'value' => function($data){
                                        return date('d.M.Y, H:i', $data->created_at);
                                    }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => function($data){
                                        return date('d.M.Y, H:i', $data->updated_at);
                                    }
                    ],
                    'ranking',
                    [
                        'class' => 'yeesoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => [
                            [Scenery::STATUS_ACTIVE, Yii::t('yee', 'Active'), 'primary'],
                            [Scenery::STATUS_INACTIVE, Yii::t('yee', 'Inactive'), 'info'],
                            [Scenery::STATUS_PIRATE, Yii::t('yee', 'Pirate'), 'danger'],
                        ],
                        'options' => ['style' => 'width:60px']
                    ],
                    ],
                ]);
            ?>
            <?php Pjax::end() ?>
        </div>
    </div>
</div>


