<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Region */

$this->title = 'Update Region: ' . ' ' . $model->id_icao_region;
$this->params['breadcrumbs'][] = ['label' => 'Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_icao_region, 'url' => ['view', 'id' => $model->id_icao_region]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="region-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>