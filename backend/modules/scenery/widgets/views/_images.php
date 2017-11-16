<?php
use backend\modules\scenery\models\Scenery;
use yii\helpers\Html;
?>

<div class="col-md-3 img-portfolio">
    <?php
        
        $imagesUrl= Yii::getAlias('@images').DIRECTORY_SEPARATOR.Scenery::getSubDirs($model['id']);
        
        echo Html::img($imagesUrl, [
            'class' => 'img-responsive img-thumbnail rounded',
            'title' => $model['name'],
            'style' => 'height: 180px; width: 240px; margin-top: 5px',
        ]);
    ?>
</div>


