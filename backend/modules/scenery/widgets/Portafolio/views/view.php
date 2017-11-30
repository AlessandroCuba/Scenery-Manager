<?php   

use backend\modules\scenery\models\Scenery;
use yii\helpers\ArrayHelper;
use kartik\helpers\Html;

    if(count($items)){
        foreach ($items as $item) { ?>
            <div class="col-md-4">
                <div class="list-container">
                    <div class="list-shot">
                        <?php
                            $id = join(', ', ArrayHelper::map($item->attachment, 'id', 'id')); 
                            if(!empty($id)){
                                $imagesUrl = Yii::getAlias('@images').DIRECTORY_SEPARATOR.Scenery::getSubDirs($id); 
                            }else {
                                $imagesUrl = Yii::getAlias('@images').DIRECTORY_SEPARATOR.'noimage'.DIRECTORY_SEPARATOR.'no_image.png';
                            }
                            $image = Html::img($imagesUrl, ['class' => 'imageview4 img-reponsive', 'title' => $item['icao']]);
                        ?>
                        <?= Html::a($image, ['scenery/view/'.$item->id]) ?>
                        
                        <h5><?= Html::bsLabel($item->icao, Html::TYPE_PRIMARY) ?></h5>
                        <p><?= $item->creator ?></p>
                        <span><?= $item->simulator->catsimulator ?></span>
                    </div>
                </div>
            </div>
        <?php } 
    }
?>