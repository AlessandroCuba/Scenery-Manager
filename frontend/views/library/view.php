<?php

use yii\widgets\Breadcrumbs;
use kartik\helpers\Html;
use kartik\icons\Icon;
use yii\timeago\TimeAgo;
use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;
use newerton\fancybox\FancyBox;
use geertw\Yii2\Adsense\AdsenseWidget;
use yeesoft\comments\widgets\Comments;

use backend\modules\scenery\models\Libraries;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sceneries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12">
    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]);?>
</div>

<div class="col-md-9">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title bold">
                <?= Html::bsLabel($model->name, Html::TYPE_SUCCESS) ?>
            </h3>    
        </div>
        <div class="panel-body">
            <?php 
                $modelname = \yii\helpers\StringHelper::basename(get_class($model));
                $files = \nemmo\attachments\models\File::find()->where(['itemId' => $model->id, 'model' => $modelname])->all();
                $items = [];
                
                foreach ($files as $file){
                    $imageURL = Yii::getAlias('@images').DIRECTORY_SEPARATOR.Libraries::getSubDirs($file->id); 
                    $items[] = Html::a(Html::img($imageURL, ['width' => 250]), $imageURL, ['rel' => 'gl-fancybox']);
                }
                 
                if(count($files)){ ?>
            
                    <?= Slick::widget([
                            'itemContainer' => 'div', 
                            'containerOptions' => ['class' => 'slick-container'], 
                            'items' => $items, 
                            'itemOptions' => ['class' => 'img-thumbnail'], 
                            'clientOptions' => [
                                'lazyLoad' => 'ondemand', 
                                'infinite' => true, 
                                'speed' => 300, 
                                'variableWidth' => true, 
                                'centerMode' => true, 
                                'dots' => false,
                                'arrows' => true,
                                'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
                            ]
                    ]); 
                    echo FancyBox::widget([
                            'target' => 'a[rel=gl-fancybox]',
                            'helpers' => true,
                            'mouse' => true,
                            'config' => [
                                'maxWidth' => '95%',
                                'maxHeight' => '95%',
                                'playSpeed' => 2000,
                                'padding' => 0,
                                'fitToView' => false,
                                'width' => '70%',
                                'height' => '70%',
                                'autoSize' => false,
                                'closeClick' => false,
                                'openEffect' => 'elastic',
                                'closeEffect' => 'elastic',
                                'prevEffect' => 'elastic',
                                'nextEffect' => 'elastic',
                                'closeBtn' => false,
                                'openOpacity' => true,
                                'helpers' => [
                                    'title' => ['type' => 'float'],
                                    'buttons' => [],
                                    'thumbs' => ['width' => 68, 'height' => 50],
                                    'overlay' => [
                                        'css' => [
                                            'background' => 'rgba(0, 0, 0, 0.8)'
                                        ]
                                    ]
                                ],
                            ]
                    ]);
                }
            ?>
            <div style="width: 728px; height: 90px">
                <?= AdsenseWidget::widget(); ?>
            </div>
            <table class="table responsive">
                <tbody>
                    <tr>
                        <td class="heading-table">Name</td>
                        <td>:</td>
                        <td class="table-name"><?= $model->name ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Name</td>
                        <td>:</td>
                        <td class="table-name"><?= $model->author ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Description</td>
                        <td>:</td>
                        <td class="table-name"><?= $model->description ?></td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
    <?php if ($model->comment_status == Libraries::COMMENT_STATUS_OPEN): ?>
    <?php echo Comments::widget(['model' => Libraries::className(), 'model_id' => $model->id]); ?>
    <?php endif; ?>
</div>
<div class="col-md-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-center bold">File Information</h3>    
        </div>
        <div class="panel-body">
            <table class="table responsive">
                <tbody>
                    <tr>
                        <td class="heading-table">File by</td>
                        <td>:</td>
                        <td class="table-name"><?= $model->created_by ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Created</td>
                        <td>:</td>
                        <td class="table-name"><?= TimeAgo::widget(['timestamp' => $model->created_at]) ?></td>
                    </tr>
                    <tr>
                        <td class="heading-table">Updated</td>
                        <td>:</td>
                        <td class="table-name"><?= TimeAgo::widget(['timestamp' => $model->updated_at]) ?></td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="3">
                        <?php 
                        if(!Yii::$app->user->isGuest){ 
                            echo Html::a(Icon::show('download', [], Icon::FA).' Download', 
                                    $model->url, 
                                    ['target'=>'_blank', 'class' => 'btn btn-primary']);
                        }else{
                            'Link only for User';
                        }
                        ?>
                        </td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-body">
            <?= AdsenseWidget::widget(); ?>
        </div>
    </div>
</div>