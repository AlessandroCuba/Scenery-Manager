<?php

use yeesoft\comments\widgets\Comments;
use yeesoft\post\models\Post;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

/* @var $post yeesoft\post\models\Post */

$this->title = Yii::t('app', 'Blog');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-lg-12">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);?>
</div>
<div class="col-md-8">
    <?php
        foreach ($posts as $post){
            echo $this->render('/items/post.php', ['post' => $post, 'page' => 'index', 'read' => 1]);
        }?>
    <div class="text-center">
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
<div class="col-md-4"> 
    <?= $this->render('left'); ?>
</div>


