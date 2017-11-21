<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\typeahead\TypeaheadBasic;
use kartik\widgets\DepDrop;

use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\models\Region;

/* @var $this yii\web\View */
/* @var $model frontend\models\ScenerySearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="scenery-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    
    <?= $form->field($model, 'region')->widget(Select2::classname(), [
            'data' => Region::getRegionList(),
            'language' =>Yii::$app->language,
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => [
                'placeholder' => 'Select a Region ...',
                //'multiple'=>true,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ])->label(false);?>
    
    <?= $form->field($model, 'country')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            //'options' => ['multiple'=>true],
            'select2Options'=>[
                'language' =>Yii::$app->language,
                'pluginOptions'=>['allowClear'=>true]],
            'pluginOptions' => [
                'depends' => [Html::getInputId($model, 'region')],
                'placeholder' => 'Select Country...',
                'url' => Url::to(['scenery/country'])
            ],
    ])->label(false);?>
    
    <?= $form->field($model, 'icao')->widget(TypeaheadBasic::classname(), [
            'data' => Scenery::getAirportList(),
            'pluginOptions' => ['highlight' => true],
            'options' => ['placeholder' => 'Filter ICAO ...'],
    ])->label(false); ?>
    
    <?= $form->field($model, 'catesim')->widget(Select2::classname(), [
            'data' => Scenery::getSimList(),
            'language' =>Yii::$app->language,
            'options' => ['placeholder' => 'Select a Simulator ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ])->label(false);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
