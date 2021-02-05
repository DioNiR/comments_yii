<?php

namespace app\models;

use DateInterval;
use DateTime;
use Yii;
use yii\db\ActiveRecord;

/**
 * Class Comment
 * @package app\models
 *
 * @property int $id
 * @property int $parentId
 * @property \DateTime $date
 * @property string $comment_text
 * @property string $authorId
 * @property string $author_name
 * @property int $hide
 *
 */
class Comment extends ActiveRecord
{
    public $comments = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_text', 'author_name',], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'comment_text' => Yii::t('app', 'Комментарий'),
            'author_name' => Yii::t('app', 'Имя'),
        ];
    }

    /**
     * @return array|ActiveRecord[]
     */
    public function getChildComments()
    {
        return self::find()->where(['=', 'parentId', $this->id])->andWhere(['=', 'hide', 0])->all();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function checkDelete(): bool
    {
        /** TODO: По хорошему такое надо в модельку */
        $dateComment = new DateTime($this->date);
        $dateComment->add(new DateInterval('PT1H'));
        $thisDate = new DateTime();

        if (session_id() === $this->authorId) {
            if ($thisDate < $dateComment) {
                return true;
            }
        }

        return false;
    }
}