<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_type`.
 */
class m181201_190556_create_tour_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tour_type');
    }
}
