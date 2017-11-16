<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yeesoft\grid\GridView;
use yeesoft\grid\GridQuickLinks;
use backend\modules\scenery\models\Libraries;
use yeesoft\helpers\Html;
use yeesoft\grid\GridPageSize;
use yii\timeago\TimeAgo;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\scenery\models\LibrariesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Libraries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libraries-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['libraries/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                    /* echo GridQuickLinks::widget([
                        'model' => Libraries::className(),
                        'searchModel' => $searchModel,
                    ])*/
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'libraries-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'libraries-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'libraries-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'libraries-grid',
                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => 'libraries',
                        'title' => function(Libraries $model) {
                            return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                    ],

                    'name',
                    'description:ntext',
                    'author',
                    [
                        'attribute' => 'created_at',
                        'format' => 'raw',
                        'value' => function ($data){
                                        return TimeAgo::widget(['timestamp' => $data->created_at]);
                                    }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'raw',
                        'value' => function ($data){
                                        return TimeAgo::widget(['timestamp' => $data->updated_at]);
                                    }
                    ],
                    // 'created_by',
                    // 'updated_by',
                    // 'videoUrl:ntext',
                    // 'url:ntext',
                    // 'ranking',
                    [
                        'class' => 'yeesoft\grid\columns\StatusColumn',
                        'attribute' => 'status',
                        'optionsArray' => [
                                [Libraries::STATUS_ACTIVE, Yii::t('yee', 'Active'), 'primary'],
                                [Libraries::STATUS_INACTIVE, Yii::t('yee', 'Inactive'), 'info'],
                        ],
                        'options' => ['style' => 'width:60px']
                    ],
                ],
            ]);?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


