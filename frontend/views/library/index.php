<?php

use yii\widgets\ListView;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Library');
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
<div class="col-lg-12">
<?= ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{pager}{items}',
            'options' => [
                'tag' => 'div',
                'class' => 'row',
                'id' => 'list-wrapper',
            ],
            'pager' => [
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last',
                'maxButtonCount' => 4,
                'options' => [
                    'class' => 'pagination col-xs-12'
                ]
            ],
            'itemView' => 'items/_libraryList',
    ])?>
</div>