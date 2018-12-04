<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attr_group`.
 */
class m181204_043753_create_attr_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attr_group', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'rank' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attr_group');
    }
}
