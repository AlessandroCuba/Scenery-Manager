<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Page Heading/Breadcrumbs -->
<!-- /.row -->
<!-- Intro Content -->
<div class="row">
    <div class="col-lg-12">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <img class="img-responsive" src="http://placehold.it/750x450" alt="">
    </div>
    <div class="col-md-6">
        <h2>About Modern Business</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
    </div>
</div>
<!-- /.row -->