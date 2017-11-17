<?php

use yii\widgets\DetailView;
use yeesoft\helpers\Html;
use yii2mod\rating\StarRating;

use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\widgets\ImagesScenery;


/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = $model->icao;
$this->params['breadcrumbs'][] = ['label' => 'Sceneries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="scenery-view">

    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['scenery/update', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-primary'])
                ?>
                <?= Html::a('Delete', ['scenery/delete', 'id' => $model->id],
                    [
                    'class' => 'btn btn-sm btn-default',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
                <?= Html::a(Yii::t('yee', 'Add New'), ['scenery/create'],
                    ['class' => 'btn btn-sm btn-primary pull-right'])
                ?>
            </p>

            <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'icao',
                        'creator',
                        [
                            'attribute' => 'description',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'catesim',
                            'format' => 'raw',
                            'value' => $model->simulator->catsimulator
                        ],
                        'url_video:url',
                        'url_download:url',
                        [
                            'attribute' => 'created_at',
                            'value' => date('d.M.Y, H:i', $model->created_at)
                        ],
                        [
                            'attribute' => 'updated_at',
                            'format' => 'raw',
                            'value' => date('d.M.Y, H:i', $model->updated_at)
                        ],
                        [
                            'attribute' => 'ranking',
                            'format' => 'raw',
                            'value' => StarRating::widget([
                                            'name' => 'ranking',
                                            'value' => $model->ranking,
                                            'clientOptions' => ['displayOnly' => true, 'readOnly' => true]
                                        ])
                        ],
                        [
                            'attribute' => 'status',
                            'format'=>'raw',
                            'value' => Scenery::getStatus($model->status),
                        ]
                    ],
                ]);
                
                echo ImagesScenery::widget([
                    'id' => $model->id
                ])
            ?>
            
        </div>
    </div>

</div>
