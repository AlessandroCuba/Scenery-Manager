<?php

use kartik\helpers\Html;
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = $model->icao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sceneries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?= Html::bsLabel($model->icao, Html::TYPE_SUCCESS).' '.Html::encode($model->airport->Name) ?>
            </h3>
        </div>
        <div class="panel-body">
            
        </div>
    </div>
</div>
<div class="col-md-3">
    <?= AviationMapEmbed::widget([
        'latitude'  => $model->airport->Latitude,
        'longitude' => $model->airport->Longitude,
        'zoomMap' => '2',
        'typeMap' => AviationMapEmbed::VFR_SEC,
        'divId' => 1,
    ]); ?>
    <?= AviationMapEmbed::widget([
        'latitude'  => $model->airport->Latitude,
        'longitude' => $model->airport->Longitude,
        'zoomMap' => '4',
        'typeMap' => 'l',
        'divId' => 0,
    ]);?>
</div>