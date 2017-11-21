<?php
use yii\widgets\ListView;

?>


<?= ListView::widget([
            'dataProvider' => $dataProvider,
            //'itemView' => 'items/_sceneryList',
        ])?>