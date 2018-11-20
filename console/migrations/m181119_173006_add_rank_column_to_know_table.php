<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `know`.
 */
class m181119_173006_add_rank_column_to_know_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('know', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('know', 'rank');
    }
}
