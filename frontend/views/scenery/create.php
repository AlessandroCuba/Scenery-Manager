<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\Scenery */

$this->title = Yii::t('app', 'Create Scenery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sceneries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scenery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
