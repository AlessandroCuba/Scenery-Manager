<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Surface */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Surface',
]) . $model->SurfaceType;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Surfaces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->SurfaceType, 'url' => ['view', 'id' => $model->SurfaceType]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="surface-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
