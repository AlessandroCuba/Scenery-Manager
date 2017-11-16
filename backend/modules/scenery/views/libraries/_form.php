<?php

use yeesoft\widgets\ActiveForm;
use yeesoft\helpers\Html;
use nemmo\attachments\components\AttachmentsInput;
use yeesoft\media\widgets\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Libraries */
/* @var $form yeesoft\widgets\ActiveForm */
?>

<div class="libraries-form">

    <?php 
    $form = ActiveForm::begin([
            'id' => 'libraries-form',
            'validateOnBlur' => false,
        ])
    ?>

    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <?= $form->field($model, 'name')->textInput() ?>
                    
                    <?= $form->field($model, 'description')->widget(TinyMce::className()); ?>

                    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'videoUrl')->textarea(['rows' => 1]) ?>

                    <?= $form->field($model, 'url')->textarea(['rows' => 1]) ?>
                    
                    <?= AttachmentsInput::widget([
                            'id' => 'file-input',       // Optional
                            'model' => $model,
                            'options' => [              // Options of the Kartik's FileInput widget
                                'multiple' => true,     // If you want to allow multiple upload, default to false
                                'resizeImages' => true,
                            ],
                            'pluginOptions' => [        // Plugin options of the Kartik's FileInput widget 
                                'maxFileCount' => 10    // Client max files
                            ]
                    ]) ?>

                </div>

            </div>
        </div>

        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="record-info">
                        <?php if(!$model->isNewRecord): ?>
                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;"><?=  $model->attributeLabels()['id'] ?>: </label>
                            <span><?=  $model->id ?></span>
                        </div>
                        <div class="form-group clearfix">
                            <?= $form->field($model, 'status', [
                                'template' => '{label}<div>{input}</div>{hint}{error}',
                                'labelOptions' => ['class' => 'control-label']
                                ])->dropDownList(Scenery::getStatusList())
                            ?>
                        </div>
                        
                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['created_at'] ?> :
                            </label>
                            <span><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
                            <span><?= Yii::$app->formatter->asTime($model->created_at) ?></span>
                        </div>
                        <div class="form-group clearfix">
                            <label class="control-label" style="float: left; padding-right: 5px;">
                                <?= $model->attributeLabels()['updated_at'] ?> :
                            </label>
                            <span><?= Yii::$app->formatter->asDate($model->updated_at) ?></span>
                            <span><?= Yii::$app->formatter->asTime($model->updated_at) ?></span>
                        </div>
                        <?php endif;?>

                        <div class="form-group">
                            <?php  if ($model->isNewRecord): ?>
                                <?= Html::submitButton(Yii::t('yee', 'Create'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('yee', 'Save'), ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('yee', 'Delete'),
                                    ['delete', 'id' => $model->id], [
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
