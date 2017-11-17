<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yeesoft\grid\GridView;
use yeesoft\grid\GridQuickLinks;
use backend\modules\scenery\models\SceneryTag;
use yeesoft\helpers\Html;
use yeesoft\grid\GridPageSize;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\scenery\models\SceneryTagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Scenery Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scenery-tag-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                    /* echo GridQuickLinks::widget([
                        'model' => SceneryTag::className(),
                        'searchModel' => $searchModel,
                    ])*/
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'scenery-tag-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'scenery-tag-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'scenery-tag-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'scenery-tag-grid',
                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => '/scenery-tag/default',
                        'title' => function(SceneryTag $model) {
                            return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                    ],

            'id',
            'tag',
            'slug',
            'created_at',
            'updated_at',
            // 'created_by',
            // 'updated_by',

                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


