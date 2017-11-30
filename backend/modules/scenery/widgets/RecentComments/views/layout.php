<?php
use kartik\icons\Icon;

?>

<div class="panel panel-default widget">
        <div class="panel-heading">
            <h4><?= Icon::show('comments', [], Icon::FA).' '.Yii::t('yee', 'Recent Comments') ?></h4>
            <span class="label label-info"><?= count($recentComments) ?></span>
        </div>
        <div class="panel-body">
            <?php if (count($recentComments)): ?>
            <?php foreach ($recentComments as $comment) : ?>
                <?= $this->render($commentTemplate, ['comment' => $comment]) ?>
            <?php endforeach; ?>
            <?php else: ?>
            <h4><em><?= Yii::t('yee', 'No comments found.') ?></em></h4>
            <?php endif; ?>
        </div>
</div>
