<?php

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $data,
    'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_images',[
                        'model' => $model,
                        'index' => $index,
                    ]);
                  },
    //'summary' => false,
]);