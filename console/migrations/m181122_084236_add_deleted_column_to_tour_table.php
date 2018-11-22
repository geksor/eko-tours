<?php

use yii\db\Migration;

/**
 * Handles adding deleted to table `tour`.
 */
class m181122_084236_add_deleted_column_to_tour_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tour', 'deleted', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tour', 'deleted');
    }
}
