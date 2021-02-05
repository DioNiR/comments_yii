<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="container mb-4">
            <div class="row mb-4">
                <div class="col-8">
                    <p>This is the reference image I used for this demonstration, a photo I took of the
                        Bombay Gin Distillery near Basingstoke.</p>

                    <p>As you can see this is a complex reference image that contains perspective and buildings of
                        different
                        sizes, plus reflections, etc. Getting a good representation of this reference image is important
                        and the
                        process below should you with that.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <p>Having loaded in your photo reference image
                        Select Menu Filters – Edge Detect – Edge and that will produce this effect</p>
                </div>
            </div>
        </div>
        <div class="post-comments" id="comments">
            <?php echo $this->render('@app/views/comment/form', ['commentForm' => $commentForm, 'parentId' => 0,]); ?>
            <?php foreach ($comments as $comment): ?>
                <?php
                    echo $this->render('@app/views/comment/comment', ['commentForm' => $commentForm, 'comment' => $comment,]);
                ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
