<?php

use yii\widgets\DetailView;
use yeesoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Region */

$this->title = $model->id_icao_region;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-view">

    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a('Edit', ['region/update', 'id' => $model->id_icao_region],
                    ['class' => 'btn btn-sm btn-primary'])
                ?>
                <?= Html::a('Delete', ['region/delete', 'id' => $model->id_icao_region],
                    [
                    'class' => 'btn btn-sm btn-default',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
                <?= Html::a(Yii::t('yee', 'Add New'), ['region/create'],
                    ['class' => 'btn btn-sm btn-primary pull-right'])
                ?>
            </p>


            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'icao_region',
                    'name_region',
                    'comentare',
                ],
            ])
            ?>

        </div>
    </div>

</div>
