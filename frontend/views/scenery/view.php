<?php

use kartik\helpers\Html;
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = $model->icao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sceneries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <h3><?= Html::bsLabel($model->icao, Html::TYPE_SUCCESS).' '.Html::encode($model->airport->Name) ?></h3>
</div>
<div class="row">
    <div class="col-md-9">
        Mapa
    </div>
    <div class="col-md-3">
        <?= AviationMapEmbed::widget([
                'latitude'  => '40',
                'longitude' => '-60',
                'zoomMap' => '3',
                'typeMap' => 'l',
                            
        ]); ?>
            
            <h2>IFR</h2>
        <a target="_new" href="http://vfrmap.com/?type=ifrlc&lat=42.5&lon=-120.5&zoom=9">
            <img src="http://vfrmap.com/api?req=map&type=ifrlc&lat=42.5&lon=-120.5&zoom=9&width=350&height=350"
            accesskey=""style="border: 1px solid #ddd" width=180 height=180>
        </a>
        </div>
        <div class="row">
            <h2>VFR</h2>
            <div id="sv_1791" style="width: 200px; height: 200px;">
                Make your <a href="https://skyvector.com/">Flight Plan</a> 
                at SkyVector.com</div>
            <script src="http://skyvector.com/api/lchart?ll=-18.053288889,-70.275822222&s=3&c=sv_1791&t=l" type="text/javascript"></script>
        </div>
    </div>
</div>