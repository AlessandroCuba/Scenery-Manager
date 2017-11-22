<?php
use backend\modules\scenery\widgets\AviationMapEmbed\AviationMapEmbed;
use yii\helpers\Html;
?>

<span><h5><?= Html::encode($nameMap) ?></h5></span>
<div id="<?= $idContainer ?>" class="<?= $classContainer?>" style="height: 200px"></div>
<script src="<?= AviationMapEmbed::URL_SKYVECTOR ?>ll=-18.053288889,-70.275822222&s=<?= $zoomMap ?>&c=<?= $idContainer ?>&t=<?= $typeMap?>" type="text/javascript"></script>
