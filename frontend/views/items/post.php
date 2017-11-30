<?php 

use yii\helpers\Url;
use yii\helpers\Html;
use yeesoft\models\User;

$formatter = \Yii::$app->formatter;

/* @var $post yeesoft\post\models\Post */
$page = (isset($page)) ? $page : 'post';
?>

<!-- Blog Entries Column -->
<!-- First Blog Post -->
<h2><?= Html::a($post->title, ["/blog/{$post->slug}"], ['class' => 'text-info']) ?></h2>
        
<?= Url::toRoute(["/{$post->id}"])?>

<p><i class="fa fa-clock-o"></i> Posted on <?= $formatter->asDate($post->updated_at , 'long');?></p>

<hr>
    <?= $post->getThumbnail(['class' => 'thumbnail pull-left', 'style' => 'width: 50px height: 100px; margin: 0 7px 7px 0']) ?>
    <?= ($page === 'post') ? $post->content : $post->shortContent ?>
<hr>
<div class="clearfix" style="margin-bottom: 10px;">
    <div class="pull-left">
        <?php if ($post->category): ?>
            <b><?= Yii::t('yee/post', 'Posted in') ?></b>
            <a href="<?= Url::to(['/category/index', 'slug' => $post->category->slug]) ?>">"<?= $post->category->title ?>"</a>
        <?php endif; ?>
    </div>
    <div class="pull-right">
        <?php $tags = $post->tags; ?>
        <?php if (!empty($tags)): ?>
            <b><?= Yii::t('yee/post', 'Tags') ?>:</b>
            <?php foreach ($tags as $tag): ?>
            <?= Html::a('#' . $tag->title, ['/tag/index', 'slug' => $tag->slug], ['class' => 'label label-primary']) ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?php 
    if($read <> 0){
        echo Html::a(Yii::t('app', 'Read More <i class="fa fa-angle-right"></i>'), [
        '/site/'.$post->slug], ['class'=>'btn btn-primary']);
    }
?>