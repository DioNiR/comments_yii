<?php

namespace app\controllers;

use app\models\Comment;
use app\models\forms\CommentForm;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Class CommentsController
 * @package app\controllers
 */
class CommentsController extends Controller
{
    /**
     * @inheritDoc
     */
    protected function verbs(): array
    {
        return [
            'create' => ['POST'],
        ];
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * @return array|bool[]
     */
    public function actionCreate()
    {
        $commentModel = new CommentForm();
        if ($commentModel->load(\Yii::$app->request->post()) && $commentModel->validate()) {
            try {
                $comment = $commentModel->do();
                $commentForm = new CommentForm();
                return ['html' => $this->renderPartial('@app/views/comment/comment', ['commentForm' => $commentForm, 'comment' => $comment])];
            } catch (\Exception $e) {
                return ['status' => false, 'error' => $e->getMessage()];
            }
        }

        return ['status' => false];
    }

    /**
     * @throws \Exception
     */
    public function actionDelete()
    {
        $post = \Yii::$app->request->post();

        /** @var Comment $comment */
        $comment = Comment::find()->where(['=', 'id', $post['id']])->one();
        if (true === $comment->checkDelete()) {
            $comment->hide = 1;
            $comment->save();
        }
    }
}