<?php
use yii\helpers\Html;
use yeesoft\post\models\Post;
use yeesoft\comment\widgets\RecentComments;
use kartik\icons\Icon;
use backend\modules\scenery\widgets\Portafolio\Portafolio;

/* @var $this yii\web\View */

$this->title = 'Homepage';
?>
    <!-- Marketing Icons Section -->
    
<div class="col-md-8">
    <h2 class="title"><?= Icon::show('paper-plane', [], Icon::FA).' '.Yii::t('app', 'Last Sceneries') ?>
        <small>List</small>
    </h2>
    <?= Portafolio::widget([
        'limit' => 8,
    ]); ?>
</div>
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-fw fa-check"></i> Lastest Post</h4>
        </div>
        <div class="panel-body">
            <?php 
                $post = Post::find()->all();
                    foreach ($post as $posts){
                        echo '<ol class = "list-unstyled">'
                        .'<li>'.Html::a($posts->title, ['/site/'.$posts->slug]).'</li>'
                        .'</ol>';
                    }
                ?>
                <a href="#" class="btn btn-default">Learn all</a>
        </div>
    </div>
    <?= RecentComments::widget([
            'layout' => '@backend/modules/scenery/widgets/RecentComments/views/layout',
            'commentTemplate' => '@backend/modules/scenery/widgets/RecentComments/views/comment'
    ])?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-fw fa-gift"></i> Lastest Scenery Pack</h4>
        </div>
        <div class="panel-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, optio corporis quae nulla aspernatur in alias at numquam rerum ea excepturi expedita tenetur assumenda voluptatibus eveniet incidunt dicta nostrum quod?</p>
            <a href="#" class="btn btn-default">Learn More</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="fa fa-fw fa-compass"></i> Stadistics</h4>
        </div>
        <div class="panel-body">
            <ol class ="list-unstyled">
                <li>Total de escenarios</li>
                <ul class="list-view">
                    <li>FS2004</li>
                    <li>X-Plane</li>
                </ul>
                <li>Total de Libery</li>
            </ol>
        </div>
    </div>
</div>
