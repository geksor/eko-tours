<?php

use yii\db\Migration;

/**
 * Handles adding deleted to table `stage`.
 */
class m181122_084300_add_deleted_column_to_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('stage', 'deleted', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('stage', 'deleted');
    }
}
