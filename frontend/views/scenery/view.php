<?php

use kartik\helpers\Html;
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;
use geertw\Yii2\Adsense\AdsenseWidget;
use kartik\icons\Icon;
use yii\widgets\Breadcrumbs;
use yii\timeago\TimeAgo;
use yeesoft\media\widgets\Carousel;

use yeesoft\models\User;
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
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title bold">
                <?= Html::bsLabel($model->icao, Html::TYPE_PRIMARY).' '.Html::encode($model->airport->Name); ?>
            </h3>    
        </div>
        <div class="panel-body">
            
                <?= Carousel::widget([
                        'album' => 'carousel',
                        'contentView' => '@frontend/views/carousel/carousel',
                        //'captionView' => '@frontend/views/carousel/caption',
                        'itemsOptions' => ['class' => 'some-class']
                ]); ?>
            
            <div style="width: 728px; height: 90px">
                <?= AdsenseWidget::widget(); ?>
            </div>
            <table class="table responsive">
                <tbody>
                    <tr>
                        <td class="heading-table">Name/<abbr title="International Civil Aviation Organization" class="initialism">ICAO</abbr></td>
                        <td>:</td>
                        <td class="table-name"><?= $model->airport->Name ?> <kbd><?= $model->icao ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Country</td>
                        <td>:</td>
                        <td><?= Icon::show('cu', [], Icon::FI).' '.Country::getCountry($model->icao)['country_name'] ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Region</td>
                        <td class="">:</td>
                        <td><?= Region::getRegionName(Country::getCountry($model->icao)['regionId'])['name_region'] ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Description</td>
                        <td class="">:</td>
                        <td><?= $model->description ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Coordenate</td>
                        <td>:</td>
                        <td class="table-name"><?= '<kbd>'.Airports::getlatDMS($model->airport->Latitude).'</kbd> / <kbd>'.Airports::getLonDMS($model->airport->Longitude).'</kbd>' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center bold">File Information</h3>    
        </div>
        <div class="panel-body">
            <table class="table responsive">
                <tbody>
                    <tr>
                        <td class="heading-table">File by</td>
                        <td>:</td>
                        <td class="table-name"><?= $model->author->username ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Created</td>
                        <td>:</td>
                        <td class="table-name"><?= TimeAgo::widget(['timestamp' => $model->created_at]) ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Updated</td>
                        <td>:</td>
                        <td class="table-name"><?= TimeAgo::widget(['timestamp' => $model->updated_at]) ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Simulador</td>
                        <td>:</td>
                        <td class="table-name"><?= $model->simulator->catsimulator ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-body">
            <?= AdsenseWidget::widget(); ?>
        </div>
    </div>
    <?= AviationMapEmbed::widget([
        'latitude'  => $model->airport->Latitude,
        'longitude' => $model->airport->Longitude,
        'zoomMap' => '2',
        'typeMap' => AviationMapEmbed::VFR_SEC,
    ]); ?>
    <?= AviationMapEmbed::widget([
        'latitude'  => $model->airport->Latitude,
        'longitude' => $model->airport->Longitude,
        'zoomMap' => '4',
        'typeMap' => 'l',
    ]);?>
</div>