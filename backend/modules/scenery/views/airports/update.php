<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Airports */

$this->title = 'Update Airports: ' . ' ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Airports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="airports-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>