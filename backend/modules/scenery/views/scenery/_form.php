<?php

use yeesoft\widgets\ActiveForm;
use yeesoft\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yeesoft\media\widgets\TinyMce;
use nemmo\attachments\components\AttachmentsInput;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* Models */
//use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\models\Sim;
use backend\modules\scenery\models\Airports;
use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\models\Libraries;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */
/* @var $form yeesoft\widgets\ActiveForm */
?>

<div class="scenery-form">

    <?php 
    
    $form = ActiveForm::begin([
            'id' => 'scenery-form',
            'validateOnBlur' => false,
            'options' => ['enctype' => 'multipart/form-data']
        ])
    ?>

    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class = "row">
                        <div class="col-xs-3">
                            <?= $form->field($model, 'icao')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(Airports::find()->asArray()->all(), 'ICAO', 'ICAO'),
                                    'language' => 'de',
                                    'options' => ['placeholder' => 'Select a Simulator ...'],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]);
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <?= $form->field($model, 'catesim')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(Sim::find()->asArray()->all(), 'id_catsimulator', 'catsimulator'),
                                'language' => 'de',
                                'options' => ['placeholder' => 'Select a Simulator ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                                ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <?= $form->field($model, 'description')->widget(TinyMce::className()); ?>
                        </div>
                        
                    </div>
                    <?= $form->field($model, 'creator')->textInput(['maxlength' => true]) ?>
                    
                    <label class="control-label"><?=  $model->attributeLabels()['editableLibrary'] ?></label>
                    <div class="row">
                        <div class="col-xs-10">
                        <?= $form->field($model, 'editableLibrary')->widget(Select2::classname(), [
                                'data' => Libraries::getLibrariesList(),
                                'language' => Yii::$app->language,
                                'options' => ['multiple' => true, 'placeholder' => 'Select a Librery ...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                ],
                        ])->label(false); ?>
                        </div>
                        <div class="col-xs-2">
                            <?= Html::button('Add Library', ['value' => Url::toRoute(['libraries/create']), 'class' => 'btn btn-success', 'id' => 'modalLink']) ?>
                            <?php
                            Modal::begin([
                                'header' => '<h2>Create new Library</h2>',
                                'id' => 'libraryModal',
                            ]);
                                
                            echo "<div id='modalContent'></di>";
                            
                            Modal::end();
                            ?>
                        </div>
                    </div>
                    
                    <div class="col-xs-12">
                        <?= AttachmentsInput::widget([
                                    'id' => 'file-input',       // Optional
                                    'model' => $model,
                                    'options' => [              // Options of the Kartik's FileInput widget
                                        'multiple' => true,     // If you want to allow multiple upload, default to false
                                    ],
                                    'pluginOptions' => [        // Plugin options of the Kartik's FileInput widget 
                                        'maxFileCount' => 10    // Client max files
                                    ]
                            ]) ?>
                    </div>
                    

                    <?= $form->field($model, 'url_video')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'url_download')->textInput(['maxlength' => true]) ?>

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
                                <?= Html::a(Yii::t('yee', 'Cancel'), ['scenery/index'], ['class' => 'btn btn-default']) ?>
                            <?php  else: ?>
                                <?= Html::submitButton(Yii::t('yee', 'Save'), [
                                        'class' => 'btn btn-primary',
                                        'onclick' => "$('#file-input').fileinput('upload');"
                                ]) ?>
                                <?= Html::a(Yii::t('yee', 'Delete'),
                                    ['scenery/delete', 'id' => $model->id], [
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
