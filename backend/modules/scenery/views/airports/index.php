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
use backend\modules\scenery\models\Country;
use backend\modules\scenery\models\Airports;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\scenery\models\AirportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Airports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airports-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['airports/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                    /* echo GridQuickLinks::widget([
                        'model' => Airports::className(),
                        'searchModel' => $searchModel,
                    ])*/
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'airports-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'airports-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'airports-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'airports-grid',
                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => 'airports',
                        'title' => function(Airports $model) {
                            return Html::a($model->ID, ['view', 'id' => $model->ID], ['data-pjax' => 0]);
                        },
                    ],
                    'Name',
                    'ICAO',
                    [
                        'attribute' => 'country_name', 
                        'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'country_name',
                                        'data' => ArrayHelper::map(Country::find()->orderBy('country_name')->asArray()->all(), 'country_name', 'country_name'),
                                        'options' => ['placeholder' => 'Select a Country...'],
                                        'pluginOptions' => ['allowClear' => true],
                                    ]),
                    ],
                    'Latitude',
                    'Longtitude',
                    'Elevation',
                ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


