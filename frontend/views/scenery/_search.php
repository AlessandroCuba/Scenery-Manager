<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\typeahead\TypeaheadBasic;
use kartik\widgets\DepDrop;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use backend\modules\scenery\models\Scenery;
use backend\modules\scenery\models\Region;
use backend\modules\scenery\models\Country;
use backend\modules\scenery\models\Airports;
use backend\modules\scenery\models\Sim;

/* @var $this yii\web\View */
/* @var $model frontend\models\ScenerySearch */
/* @var $form yii\widgets\ActiveForm */

?>
<?php
    $this->registerJs(
       '$("document").ready(function(){ 
            $("#sceneryform").on("pjax:end", function() {
                $.pjax.reload({container:"#scenery"});  //Reload ListView
            });
        });'
    );
?>

<div class="scenery">
    <?php Pjax::begin(['id' => 'sceneryform']) ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['data-pjax' => true ],
    ]); ?>
    
    <?= $form->field($model, 'region')->widget(Select2::classname(), [
            'data' => Region::getRegionList(),
            'language' => Yii::$app->language,
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => [
                'placeholder' => 'Select a Region ...',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ])->label(false);?>
    
    <?= $form->field($model, 'icao_country')->widget(DepDrop::classname(), [
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options'=> [
                'theme' => Select2::THEME_BOOTSTRAP,
                'language' => Yii::$app->language,
                'pluginOptions' => ['allowClear' => true]],
            'pluginOptions' => [
                'depends' => [Html::getInputId($model, 'region')],
                'placeholder' => 'Select Country...',
                'url' => Url::to(['scenery/country']),
            ],
            'data' => Country::getCountryList($model->region),
            
    ])->label(false);?>
    
    <?= $form->field($model, 'icao')->widget(TypeaheadBasic::classname(), [
            'data' => Airports::getAirportList(),
            'pluginOptions' => ['highlight' => true],
            'options' => ['placeholder' => 'Filter ICAO ...'],
    ])->label(false); ?>
    
    <?= $form->field($model, 'catesim')->widget(Select2::classname(), [
            'data' => Sim::getSimList(),
            'language' =>Yii::$app->language,
            'options' => ['placeholder' => 'Select a Simulator ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
    ])->label(false);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), Url::to('index'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php 
        ActiveForm::end(); 
        Pjax::end();
    ?>
    
</div>
