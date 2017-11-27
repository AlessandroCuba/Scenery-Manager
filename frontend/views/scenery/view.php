<?php

use kartik\helpers\Html;
use kartik\detail\DetailView;
use yeesoft\helpers\FA;
use yii\flags\Flags;
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;
use geertw\Yii2\Adsense\AdsenseWidget;
use kartik\icons\Icon;
use yii\widgets\Breadcrumbs;


use backend\modules\scenery\widgets\ImagesScenery;
use backend\modules\scenery\models\Country;
use backend\modules\scenery\models\Region;
use backend\modules\scenery\models\Airports;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = $model->icao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sceneries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);?>
</div>


<div class="col-md-9">
    <?php
    
    $attribute = [
        [
            'group'=>true,
            'label'=> 'Airport Information',
            'rowOptions'=>['class'=>'warning']
        ],
        [
            'columns' => [[
                'label'=>'Name/ICAO',
                'value' => $model->airport->Name.' <kbd>'.$model->icao.'</kbd>',
                'displayOnly' => true,
                'format'=>'raw', 
                'valueColOptions' => ['style'=>'width:40%']
            ],[
                'attribute' => 'Coodinates', 
                'value' => '<kbd>'.Airports::getlatDMS($model->airport->Latitude).'</kbd><br><kbd>'.Airports::getLonDMS($model->airport->Longitude).'</kbd>',
                'displayOnly'=>true,
                'format' => 'raw',
            ]]
        ],
        [
            'columns' => [[
                'label' => 'Country',
                'format' => 'raw',
                'valueColOptions' => ['style'=>'width:20%'],
                'value' => Icon::show('CU', [], Icon::FI).' '.Country::getCountry($model->icao)['country_name']
            ],[
                'label' => 'Region',
                'format' => 'raw',
                'valueColOptions' => ['style'=>'width:80%'],
                'value' => Region::getRegionName(Country::getCountry($model->icao)['regionId'])['name_region'],
            ]]      
        ],
        [
            'group'=>true,
            'label'=> FA::icon('info').' Scenery Information',
            'rowOptions'=>['class'=>'warning']
        ],
        [
            'group'=>true,
            'value' => $model->description,
            //'label'=> FA::icon('info').' Scenery Information',
            //'rowOptions'=>['class'=>'warning']
        ],
       
    ];
            
    echo DetailView::widget([
        'model' => $model,
        'condensed' => true,
        'hover' => true,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => Html::bsLabel($model->icao, Html::TYPE_PRIMARY).' '.Html::encode($model->airport->Name),
            'type' => DetailView::TYPE_INFO,
        ],
        'attributes' => $attribute,
    ]);     
    ?>
    
    <div style="width: 728px; height: 90px">
        <?= AdsenseWidget::widget(); ?>
    </div>
        
</div>
<div class="col-md-3">
    <?= AviationMapEmbed::widget([
        'latitude'  => $model->airport->Latitude,
        'longitude' => $model->airport->Longitude,
        'zoomMap' => '2',
        'typeMap' => AviationMapEmbed::VFR_SEC,
    ]); ?>
    <div class="panel panel-success">
        <div class="panel-body">
            <?= AdsenseWidget::widget(); ?>
        </div>
    </div>
    
    <?= AviationMapEmbed::widget([
        'latitude'  => $model->airport->Latitude,
        'longitude' => $model->airport->Longitude,
        'zoomMap' => '4',
        'typeMap' => 'l',
    ]);?>
</div>