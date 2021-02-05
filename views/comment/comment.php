<?php
/** @var $comment \app\models\Comment */
$level = $level ?? 0;
$no_level = $no_level ?? false;
$level++;

$comments = $comment->getChildComments();
?>
<div class="media" id="comment_<?php echo $comment->id; ?>">
    <div class="media-heading">
        <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse"
                data-target="#collapse<?php echo $comment->id; ?>" aria-expanded="false" aria-controls="collapseExample"><span
                class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
        <span class="label label-info"><?php echo $comment->author_name; ?></span> <?php echo $comment->date; ?>
    </div>
    <div class="panel-collapse collapse in" id="collapse<?php echo $comment->id; ?>">
        <div class="media-body">
            <p><?php echo $comment->comment_text; ?></p>
            <div class="comment-meta">
                <?php if (true === $comment->checkDelete()): ?>
                    <span><a href="#" class="delete_comment" data-id="<?php echo $comment->id; ?>">Удалить</a></span>
                <?php endif; ?>
                <span>
                    <a class="" role="button" data-toggle="collapse" href="#replyComment_<?php echo $comment->id; ?>" aria-expanded="false"
                       aria-controls="collapseExample">Ответить</a>
                  </span>
                <div class="collapse" id="replyComment_<?php echo $comment->id; ?>">
                    <?php echo $this->render('@app/views/comment/form', ['commentForm' => $commentForm, 'parentId' => $comment->id,]); ?>
                </div>
            </div>
        </div>
        <div class="comments" id="comments_<?php echo $comment->id; ?>">
            <?php if (count($comments) > 0): ?>
                <?php if (false == $no_level && $level < 3): ?>
                    <?php /** TODO: Дубль кода! */ ?>
                    <?php foreach ($comments as $comment): ?>
                        <?php echo $this->render('@app/views/comment/comment', ['commentForm' => $commentForm, 'comment' => $comment, 'level' => $level]); ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php if (false == $no_level): ?>
                        <div><a class="show_comments" data-id="<?php echo $comment['id']; ?>">Показать комментарии</a></div>
                    <?php endif; ?>
                    <div class="hide_comments">
                        <?php /** TODO: Дубль кода! */ ?>
                        <?php foreach ($comments as $comment): ?>
                            <?php echo $this->render('@app/views/comment/comment', ['commentForm' => $commentForm, 'comment' => $comment, 'no_level' => true]); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>