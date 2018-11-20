<?php

use yii\db\Migration;

/**
 * Handles adding viewed to table `call_back`.
 */
class m181119_184327_add_viewed_column_to_call_back_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('call_back', 'viewed', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('call_back', 'viewed');
    }
}
