<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Runways */

$this->title = 'Create Runways';
$this->params['breadcrumbs'][] = ['label' => 'Runways', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="runways-create">
    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>
    <?=  $this->render('_form', compact('model')) ?>
</div>