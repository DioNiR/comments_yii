<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m210208_063228_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'parentId' => $this->integer()->defaultValue(0),
            'date' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'comment_text' => $this->text()->notNull(),
            'authorId' => $this->char(100),
            'author_name' => $this->char(10),
            'hide' => $this->tinyInteger(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comments}}');
    }
}
