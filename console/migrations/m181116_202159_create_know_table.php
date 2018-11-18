<?php

use yii\db\Migration;

/**
 * Handles the creation of table `know`.
 */
class m181116_202159_create_know_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('know', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text(),
            'image_count' => $this->integer()->defaultValue(2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('know');
    }
}
