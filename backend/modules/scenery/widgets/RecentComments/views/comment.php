<?php
use yeesoft\comments\Comments;
use yii\helpers\Html;

/* @var $this yii\web\View */

//$commentsAsset = CommentsAsset::register($this);
//Comments::getInstance()->commentsAssetUrl = $commentsAsset->baseUrl;
?>

<ul class="list-group">
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-2 col-md-3">
                <?= Html::img(Yii::getAlias('@avatar').Comments::getInstance()->renderUserAvatar($comment->user_id), ['class' => 'img-circle img-responsive'])?>
            </div>
            <div class="col-xs-10 col-md-9">
                <div>
                    <div class="mic-info">
                        By: <?= Html::encode($comment->getAuthor()).' '."{$comment->createdDate} {$comment->createdTime}" ?>
                    </div>
                </div>
                <div class="comment-text">
                    <?= $comment->shortContent ?>
                    <?= Html::a(Yii::t('yee', 'Read more...'), $comment->url) ?>
                </div>
                <div class="action">
                    
                </div>
            </div>
        </div>
    </li>
</ul>
