<?php

use yii\widgets\DetailView;
use yeesoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Airports */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Airports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="airports-view">

    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['airports/update', 'id' => $model->ID],
                    ['class' => 'btn btn-sm btn-primary'])
                ?>
                <?= Html::a('Delete', ['airports/delete', 'id' => $model->ID],
                    [
                    'class' => 'btn btn-sm btn-default',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
                <?= Html::a(Yii::t('yee', 'Add New'), ['airports/create'],
                    ['class' => 'btn btn-sm btn-primary pull-right'])
                ?>
            </p>
            
            <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'ID',
                        'Name',
                        'ICAO',
                        /*[
                            //'attribute' => 'country_name',
                            //'format' => 'raw',
                            //'value' => $model->getCountry(),
                        ],*/
                        //'country_name',
                        'PrimaryID',
                        'Latitude',
                        'Longtitude',
                        //'Elevation',
                        [
                            'attribute' => 'Elevation',
                            'label' => 'Elevation (meter)',
                            'value' => $model->Elevation.' ft / '.number_format($model->Elevation/3.2808, 2).' m',
                            'format'=> 'raw'
                        ],
                    ],
                ])
            ?>

        </div>
    </div>

</div>
