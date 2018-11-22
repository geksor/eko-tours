<?php

use yii\db\Migration;

/**
 * Handles adding deleted to table `month`.
 */
class m181122_084249_add_deleted_column_to_month_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('month', 'deleted', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('month', 'deleted');
    }
}
