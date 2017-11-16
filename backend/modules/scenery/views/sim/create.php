<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\SimType */

$this->title = Yii::t('app', 'Create Sim Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sim Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sim-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
