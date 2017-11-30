<?php
use kartik\helpers\Html;
use yeesoft\helpers\FA;
use yii\helpers\ArrayHelper;
use kartik\icons\Icon;

use backend\modules\scenery\models\Libraries;

?>
<div class="col-md-3">
    <div class="list-container">
        <div class="list-shot">
            <a href="#">
                <?php 
                $imageId = join(', ', ArrayHelper::map($model->attachment, 'id', 'id'));
                if(!empty($imageId)){
                    $imagesUrl = Yii::getAlias('@images').DIRECTORY_SEPARATOR. Libraries::getSubDirs($imageId); 
                }else {
                    $imagesUrl = Yii::getAlias('@images').DIRECTORY_SEPARATOR.'noimage'.DIRECTORY_SEPARATOR.'no_image.png';
                }

                echo Html::img($imagesUrl, [
                    'class' => 'imageview img-reponsive',
                    'title' => $model['name'],
                    //'style' => 'border: 1px solid #'.$model->simulator->color,
                ]);?>
            </a>
        </div>
        <div class="description img-responsive">
            <div class ="name text-center"><?= Html::bsLabel($model->name, Html::TYPE_PRIMARY)?></div>
            <div class ="actions text-center"><?= Html::a(Icon::show('search', ['class' => 'fa-3x'], Icon::FA), ['library/view/'.$model->id], ['class' => 'btn btn-info']) ?></div>
        </div>
        <div class="stats">
            <span class="comments"><a hrf="#"><?= Icon::show('commenting', ['class' => 'fa-large'], Icon::FA)?></a> <?= Libraries::getCommentCount($model->id) ?></span>
            <span class="download"><a hrf="#"><?= Icon::show('thumbs-up', ['class' => 'fa-large'], Icon::FA) ?></a> 150</span>
        </div>
    </div>
</div>