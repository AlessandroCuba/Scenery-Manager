<?php

use yeesoft\widgets\ActiveForm;
use backend\modules\scenery\models\Airports;
use yeesoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Airports */
/* @var $form yeesoft\widgets\ActiveForm */
?>

<div class="airports-form">

    <?php 
    $form = ActiveForm::begin([
            'id' => 'airports-form',
            'validateOnBlur' => false,
        ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">

                    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'ICAO')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'PrimaryID')->textInput() ?>

                    <?= $form->field($model, 'Latitude')->textInput() ?>

                    <?= $form->field($model, 'Longtitude')->textInput() ?>

                    <?= $form->field($model, 'Elevation')->textInput() ?>

                </div>

            </div>
        </div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;"><?=  $model->attributeLabels()['ID'] ?>: </label>
                            <span><?=  $model->ID ?></span>
                        </div>

                        <div class="form-group">
                            <?php  if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('yee', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['airports/index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Delete'),
                                    ['airports/delete', 'id' => $model->ID], [
                                    'class' => 'btn btn-default',
                                    'data' => [
                                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php  ActiveForm::end(); ?>

</div>
