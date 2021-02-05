<?php

namespace app\models\forms;

use app\models\Comment;
use Exception;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;
    public $parentId;
    public $author_name;

    public function rules()
    {
        return [
            [['comment', 'parentId', 'author_name'], "required"],
        ];
    }

    /**
     * @return Comment
     */
    public function do(): Comment
    {
        $comment = new Comment;
        $comment->comment_text = $this->comment;
        $comment->parentId = $this->parentId;
        $comment->authorId = session_id();
        $comment->author_name = $this->author_name;
        if (!$comment->save()) {
            throw new Exception('Комментарий не сохранен');
        }

        return $comment;
    }
}