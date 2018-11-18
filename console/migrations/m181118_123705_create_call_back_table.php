<?php

use yii\db\Migration;

/**
 * Handles the creation of table `call_back`.
 */
class m181118_123705_create_call_back_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('call_back', [
            'id' => $this->primaryKey(),
            'user_name' => $this->string(),
            'phone' => $this->string(),
            'is_consult' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'done_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('call_back');
    }
}
