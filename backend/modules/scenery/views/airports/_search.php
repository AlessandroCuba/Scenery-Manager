<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\AirportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="airports-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'ICAO') ?>

    <?= $form->field($model, 'PrimaryID') ?>

    <?= $form->field($model, 'Latitude') ?>

    <?php // echo $form->field($model, 'Longtitude') ?>

    <?php // echo $form->field($model, 'Elevation') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
