<?php

use kartik\helpers\Html;
use geertw\Yii2\Adsense\AdsenseWidget;
use kartik\icons\Icon;
use yii2mod\rating\StarRating;
use yii\widgets\Breadcrumbs;
use yii\timeago\TimeAgo;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use newerton\fancybox\FancyBox;
use yeesoft\comments\widgets\Comments;

use backend\modules\scenery\models\Country;
use backend\modules\scenery\models\Region;
use backend\modules\scenery\models\Airports;
use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;

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
            <?php 
                $modelname = \yii\helpers\StringHelper::basename(get_class($model));
                $files = \nemmo\attachments\models\File::find()->where(['itemId' => $model->id, 'model' => $modelname])->all();
                $items = [];
                
                foreach ($files as $file){
                    $imageURL = Yii::getAlias('@images').DIRECTORY_SEPARATOR.Scenery::getSubDirs($file->id); 
                    $items[] = Html::a(Html::img($imageURL, ['width' => 250]), $imageURL, ['rel' => 'gl-fancybox']);
                }
                if(count($files)){ ?>
            
                    <?= Slick::widget([
                            'itemContainer' => 'div', 
                            'containerOptions' => ['class' => 'slick-container'], 
                            'items' => $items, 
                            'itemOptions' => ['class' => 'img-thumbnail'], 
                            'clientOptions' => [
                                'lazyLoad' => 'ondemand', 
                                'infinite' => true, 
                                'speed' => 300, 
                                'variableWidth' => true, 
                                'centerMode' => true, 
                                'dots' => false,
                                'arrows' => true,
                                'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                            ]
                    ]); 
                    echo FancyBox::widget([
                            'target' => 'a[rel=gl-fancybox]',
                            'helpers' => true,
                            'mouse' => true,
                            'config' => [
                                'maxWidth' => '90%',
                                'maxHeight' => '90%',
                                'playSpeed' => 2000,
                                'padding' => 0,
                                'fitToView' => false,
                                'width' => '70%',
                                'height' => '70%',
                                'autoSize' => false,
                                'closeClick' => false,
                                'openEffect' => 'elastic',
                                'closeEffect' => 'elastic',
                                'prevEffect' => 'elastic',
                                'nextEffect' => 'elastic',
                                'closeBtn' => false,
                                'openOpacity' => true,
                                'helpers' => [
                                    'title' => ['type' => 'float'],
                                    'buttons' => [],
                                    'thumbs' => ['width' => 68, 'height' => 50],
                                    'overlay' => [
                                        'css' => [
                                            'background' => 'rgba(0, 0, 0, 0.8)'
                                        ]
                                    ]
                                ],
                            ]
                    ]);
                }
            ?>
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
                        <td class="heading-table">Coordenate</td>
                        <td>:</td>
                        <td class="table-name"><?= '<kbd>'.Airports::getlatDMS($model->airport->Latitude).'</kbd><br><kbd>'.Airports::getLonDMS($model->airport->Longitude).'</kbd>' ?></td>
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
                    <?php if($model->libraries){ ?>
                    <tr>
                        <td class="heading-table">Need Libraries</td>
                        <td class="">:</td>
                        <td><?php 
                            foreach ($model->libraries as $libItems){
                                $items[] = Html::a($libItems->name, ['library/view/'.$libItems->id], ['class' => 'label label-primary']);
                            }
                            echo implode(' ', $items);
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table> 
            <?= \hauntd\vote\widgets\Vote::widget([
                    'entity' => 'itemVote',
                    'model' => $model,
                    'options' => ['class' => 'vote vote-visible-buttons']
            ]); ?>
        </div>
    </div>
    <?php if ($model->comment_status == Scenery::COMMENT_STATUS_OPEN): ?>
    <?php echo Comments::widget(['model' => Scenery::className(), 'model_id' => $model->id]); ?>
    <?php endif; ?>
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
                    <tr>
                        <td class="text-center" colspan="3">
                        <?php 
                        if(!Yii::$app->user->isGuest){ 
                            echo Html::a(Icon::show('download', [], Icon::FA).' Download', 
                                    $model->url_download, 
                                    ['target'=>'_blank', 'class' => 'btn btn-primary']);
                        }else{
                            'Link only for User';
                        }
                        ?>
                        </td>                        
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