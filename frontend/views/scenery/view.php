<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = $model->icao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sceneries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
    <h1><?= Html::encode($model->icao.' '.$model->airport->Name) ?></h1>
</div>
<div class="row">
    <div class="col-md-8">
        Mapa
    </div>
    <div class="col-md-4">
        content
    </div>
</div>
