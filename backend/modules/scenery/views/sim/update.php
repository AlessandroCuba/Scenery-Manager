<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\SimType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sim Type',
]) . $model->id_catsimulator;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sim Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_catsimulator, 'url' => ['view', 'id' => $model->id_catsimulator]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sim-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
