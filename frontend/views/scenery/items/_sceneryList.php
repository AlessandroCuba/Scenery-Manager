<?php
use yii2mod\rating\StarRating;
use yii\helpers\ArrayHelper;
use yeesoft\helpers\FA;
use kartik\helpers\Html;
use yii\helpers\StringHelper;

use backend\modules\scenery\models\Scenery;
?>

<div class="col-md-3">
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
        <div class="scenery-description img-responsive">
            <div class ="name text-center"><?= Html::bsLabel($model->icao, Html::TYPE_PRIMARY).' '.Html::bsLabel($model->simulator->catsimulator, Html::TYPE_PRIMARY)?></div>
            <div class ="description text-center"><?= $model->airport->Name ?></div>
            <div class ="action text-center"><?= Html::a(FA::icon('eye').' | View', ['scenery/view/'.$model->id], ['class' => 'btn btn-info']) ?></div>
        </div>
        <div class="stats">
            <span class="comments"><a hrf="#"><?= FA::icon('commenting')?></a> 54</span>
            <span class="download"><a hrf="#"><?= FA::icon('thumbs-up ')?></a> 150</span>
        </div>
    </div>
</div>