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
use backend\modules\scenery\models\Region;
use backend\modules\scenery\models\Country;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\scenery\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <div class="row">
        <div class="col-sm-12">
            <h3 class="lte-hide-title page-title"><?=  Html::encode($this->title) ?></h3>
            <?= Html::a(Yii::t('yee', 'Add New'), ['country/create'], ['class' => 'btn btn-sm btn-primary']) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-6">
                    <?php 
                    /* Uncomment this to activate GridQuickLinks */
                    /* echo GridQuickLinks::widget([
                        'model' => Country::className(),
                        'searchModel' => $searchModel,
                    ])*/
                    ?>
                </div>

                <div class="col-sm-6 text-right">
                    <?=  GridPageSize::widget(['pjaxId' => 'country-grid-pjax']) ?>
                </div>
            </div>

            <?php 
            Pjax::begin([
                'id' => 'country-grid-pjax',
            ])
            ?>

            <?= 
            GridView::widget([
                'id' => 'country-grid',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'bulkActionOptions' => [
                    'gridId' => 'country-grid',
                    'actions' => [ Url::to(['bulk-delete']) => 'Delete'] //Configure here you bulk actions
                ],
                'columns' => [
                    ['class' => 'yeesoft\grid\CheckboxColumn', 'options' => ['style' => 'width:10px']],
                    [
                        'class' => 'yeesoft\grid\columns\TitleActionColumn',
                        'controller' => 'country',
                        'title' => function(Country $model) {
                            return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                        },
                    ],
                    'icao_country',
                    'country_name',
                    'alpha2code',
                    [
                        'label' => Yii::t('app', 'Region'),
                        'value' => 'region.name_region',
                        'filter' => Select2::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'regionId',
                                        'data' => ArrayHelper::map(Region::find()->asArray()->all(), 'icao_region', 'name_region'),
                                        'options' => ['placeholder' => 'Select a Region ...'],
                                        'pluginOptions' => ['allowClear' => true],
                                    ]),
                        'options' => ['width' => '35%'],
                    ],
                    //'regionId',
                    ],
            ]);
            ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>


