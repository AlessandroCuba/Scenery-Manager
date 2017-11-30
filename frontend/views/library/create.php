<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Libraries */

$this->title = 'Create Libraries';
$this->params['breadcrumbs'][] = ['label' => 'Libraries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="libraries-create">
    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>
    <?=  $this->render('_form', compact('model')) ?>
</div>