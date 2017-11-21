<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scenery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'icao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creator')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catesim')->textInput() ?>

    <?= $form->field($model, 'url_video')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url_download')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ranking')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
