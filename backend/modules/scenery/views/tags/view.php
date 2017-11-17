<?php

use yii\widgets\DetailView;
use yeesoft\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\scenery\models\SceneryTag */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Scenery Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scenery-tag-view">

    <h3 class="lte-hide-title"><?=  Html::encode($this->title) ?></h3>

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?=                 Html::a('Edit', ['/scenery-tag/default/update', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-primary'])
                ?>
                <?=                 Html::a('Delete', ['/scenery-tag/default/delete', 'id' => $model->id],
                    [
                    'class' => 'btn btn-sm btn-default',
                    'data' => [
                        'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ])
                ?>
                <?=                 Html::a(Yii::t('yee', 'Add New'), ['/scenery-tag/default/create'],
                    ['class' => 'btn btn-sm btn-primary pull-right'])
                ?>
            </p>


            <?=             DetailView::widget([
                'model' => $model,
                'attributes' => [
            'id',
            'tag',
            'slug',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
                ],
            ])
            ?>

        </div>
    </div>

</div>
