<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour`.
 */
class m181116_192902_create_tour_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string(),
            'short_description' => $this->string(),
            'description' => $this->text(),
            'meta_title' => $this->string(),
            'meta_description' => $this->text(),
            'rank' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
            'hot' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tour');
    }
}
