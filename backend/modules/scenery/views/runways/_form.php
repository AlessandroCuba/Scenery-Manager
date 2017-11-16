<?php

//use yeesoft\widgets\ActiveForm;
use yeesoft\helpers\Html;
use kartik\select2\Select2;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;

/* Models */
use backend\modules\scenery\models\Runways;
use backend\modules\scenery\models\Airports;
use backend\modules\scenery\models\Surface;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Runways */
/* @var $form yeesoft\widgets\ActiveForm */
?>

<div class="runways-form">

    <?php 
    $form = ActiveForm::begin([
            'id' => 'runways-form',
            'validateOnBlur' => false,
        ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <?php // = $form->field($model, 'id')->textInput() ?>

                    <?php //= $form->field($model, 'AirportID')->textInput() ?>
                    
                    <?= $form->field($model, 'AirportID')->widget(Select2::classname(), [
                            'data'=>ArrayHelper::map(Airports::find()->orderBy('ID')->asArray()->all(), 'ID', 'ICAO'),
                            'pluginOptions'=>['allowClear'=> true],
                            'options' => ['placeholder'=>'Select Airport...']
                        ]);
                    ?>

                    <?= $form->field($model, 'Ident')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'TrueHeading')->textInput() ?>

                    <?= $form->field($model, 'Length')->textInput() ?>

                    <?= $form->field($model, 'Width')->textInput() ?>

                    <?= $form->field($model, 'Surface')->widget(Select2::classname(), [
                            'data'=>ArrayHelper::map(Surface::find()->orderBy('SurfaceType')->asArray()->all(), 'SurfaceType', 'Description'),
                            'pluginOptions'=>['allowClear'=> true],
                            'options' => ['placeholder'=>'Select Surface...']
                        ]);
                    ?>
                    <?php //= $form->field($model, 'Surface')->textInput(['maxlength' => true]) ?>

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
                            <label class="control-label" style="float: left; padding-right: 5px;"><?=  $model->attributeLabels()['id'] ?>: </label>
                            <span><?=  $model->id ?></span>
                        </div>

                        <div class="form-group">
                            <?php  if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('yee', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['runways/index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Delete'),
                                    ['runways/delete', 'id' => $model->id], [
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
