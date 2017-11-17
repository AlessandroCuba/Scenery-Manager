<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\SceneryTag */

$this->title = 'Update Scenery Tag: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Scenery Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="scenery-tag-update">
    <h3 class="lte-hide-title"><?= Html::encode($this->title) ?></h3>
    <?= $this->render('_form', compact('model')) ?>
</div>