<?php

use yii\db\Migration;

/**
 * Handles adding description to table `room`.
 */
class m200312_171604_add_description_column_to_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('room', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('room', 'description');
    }
}
