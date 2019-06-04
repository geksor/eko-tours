<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m190604_174646_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string(),
            'description' => $this->text(),
            'meta_title' => $this->string(),
            'meta_description' => $this->text(),
            'rank' => $this->integer()->defaultValue(100),
            'publish' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
