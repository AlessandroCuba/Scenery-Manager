<?php
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;
use yii\helpers\Html;
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title text-center bold">
            <?= Html::encode($nameMap) ?>
        </h3>
    </div>
    <div class="panel-body">
        <div id="<?= $idContainer ?>" class="<?= $classContainer?>" style="height: 200px"></div>
        <script src="<?= AviationMapEmbed::URL_SKYVECTOR ?>ll=<?= $latitude ?>,<?= $longitude?>&s=<?= $zoomMap ?>&c=<?= $idContainer ?>&t=<?= $typeMap?>" type="text/javascript"></script>
    </div>
</div>