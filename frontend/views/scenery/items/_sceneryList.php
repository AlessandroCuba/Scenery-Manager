<?php
use yii2mod\rating\StarRating;
use yii\helpers\ArrayHelper;
use yeesoft\helpers\FA;
use kartik\helpers\Html;
use kartik\icons\Icon;

use backend\modules\scenery\models\Scenery;
?>

<div class="col-md-4">
    <div class="list-container">
        <div class="list-shot">
            <a href="#">
                <?php 
                $imageId = join(', ', ArrayHelper::map($model->attachment, 'id', 'id'));
                if(!empty($imageId)){
                    $imagesUrl = Yii::getAlias('@images').DIRECTORY_SEPARATOR.Scenery::getSubDirs($imageId); 
                }else {
                    $imagesUrl = Yii::getAlias('@images').DIRECTORY_SEPARATOR.'noimage'.DIRECTORY_SEPARATOR.'no_image.png';
                }

                echo Html::img($imagesUrl, [
                    'class' => 'imageview img-reponsive',
                    'title' => $model['icao'],
                    //'style' => 'border: 1px solid #'.$model->simulator->color,
                ]);?>
            </a>
        </div>
        <div class="description img-responsive">
            <div class ="name text-center"><?= Html::bsLabel($model->icao, Html::TYPE_PRIMARY).' '.Html::bsLabel($model->simulator->catsimulator, Html::TYPE_PRIMARY)?></div>
            <div class ="actions text-center"><?= Html::a(Icon::show('search', ['class' => 'fa-3x'], Icon::FA), ['scenery/view/'.$model->id], ['class' => 'btn btn-info']) ?></div>
        </div>
        <div class="stats">
            <span class="comments"><a hrf="#"><?= FA::icon('commenting')?></a> <?= Scenery::getCommentCount($model->id) ?></span>
            <span class="download"><a hrf="#"><?= FA::icon('thumbs-up ')?></a> 150</span>
        </div>
    </div>
</div>