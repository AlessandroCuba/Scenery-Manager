<?php

use yii\widgets\DetailView;
use yeesoft\helpers\Html;

/* Models */
use backend\modules\scenery\models\Airports;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Runways */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Runways', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="runways-view">

    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['runways/update', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-primary'])
                ?>
                <?= Html::a('Delete', ['runways/delete', 'id' => $model->id],
                    [
                    'class' => 'btn btn-sm btn-default',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
                <?= Html::a(Yii::t('yee', 'Add New'), ['runways/create'],
                    ['class' => 'btn btn-sm btn-primary pull-right'])
                ?>
            </p>


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    [
                        'label' => 'Airport Name',
                        'attribute' => 'AirportID',
                        'format'=>'raw',
                        'value'=>$model->airport->Name,
                    ],
                    'Ident',
                    'TrueHeading',
                    'Elevation',
                    'Length',
                    'Width',
                    [
                        'label' => 'Surface Type',
                        'attribute' => 'Surface',
                        'format'=>'raw',
                        'value'=>$model->surface->Description,
                    ],
                    //'Surface',
                    'Latitude',
                    'Longtitude',
                ],
            ])
            ?>

        </div>
    </div>

</div>
