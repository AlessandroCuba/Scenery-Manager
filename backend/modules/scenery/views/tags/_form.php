<?php

use yeesoft\widgets\ActiveForm;
use backend\modules\scenery\models\SceneryTag;
use yeesoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\SceneryTag */
/* @var $form yeesoft\widgets\ActiveForm */
?>

<div class="scenery-tag-form">

    <?php 
    $form = ActiveForm::begin([
            'id' => 'scenery-tag-form',
            'validateOnBlur' => false,
        ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'created_at')->textInput() ?>

                    <?= $form->field($model, 'updated_at')->textInput() ?>

                    <?= $form->field($model, 'created_by')->textInput() ?>

                    <?= $form->field($model, 'updated_by')->textInput() ?>

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
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['/scenery-tag/default/index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Delete'),
                                    ['/scenery-tag/default/delete', 'id' => $model->id], [
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
