<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\SceneryTag */

$this->title = 'Create Scenery Tag';
$this->params['breadcrumbs'][] = ['label' => 'Scenery Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="scenery-tag-create">
    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>
    <?=  $this->render('_form', compact('model')) ?>
</div>