<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = 'Create Scenery';
$this->params['breadcrumbs'][] = ['label' => 'Sceneries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="scenery-create">
    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>
    <?=  $this->render('_form', compact('model')) ?>
</div>