<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ScenerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sceneries');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);?>
</div>
<div class="col-lg-12">
    <h1 class="page-header"><?= Html::encode($this->title) ?>
        <small>List</small>
    </h1>
</div>

    <div class="col-md-3">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    
    <div class="col-md-9">
        <?php Pjax::begin(['id' => 'scenery']) ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'options' => [
                'tag' => 'div',
                'class' => 'row',
                'id' => 'list-wrapper',
            ],
            'itemView' => 'items/_sceneryList',
        ])?>
        <?php Pjax::end() ?>
    </div>
