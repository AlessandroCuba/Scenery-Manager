<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use yeesoft\grid\GridView;
use yeesoft\grid\GridQuickLinks;
use yeesoft\helpers\Html;
use yeesoft\grid\GridPageSize;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* Models */
use backend\modules\scenery\models\Runways;
use backend\modules\scenery\models\Airports;
 

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\scenery\models\RunwaysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Runways';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="runways-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['runways/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                    /* echo GridQuickLinks::widget([
                        'model' => Runways::className(),
                        'searchModel' => $searchModel,
                    ])*/
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'runways-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'runways-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'runways-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'runways-grid',
                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => 'runways',
                        'title' => function(Runways $model) {
                            return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                    ],

            //'id',
            [
                'label' => Yii::t('app', 'Airport'),
                'value' => 'airport.Name',
                'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'AirportID',
                                'data' => ArrayHelper::map(Airports::find()->orderBy('ID')->asArray()->all(), 'ID', 'ICAO'),
                                'options' => ['placeholder' => 'Select a Airport ...'],
                                'pluginOptions' => ['allowClear' => true],
                            ]),
                'options' => ['width' => '20%'],
            ],
            //'AirportID',
            'Ident',
            'TrueHeading',
            'Length',
            // 'Width',
            [
                'label' => 'Surface Type',
                'value' => 'surface.Description'
            ],
            // 'Latitude',
            // 'Longtitude',
            // 'Elevation',

                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


