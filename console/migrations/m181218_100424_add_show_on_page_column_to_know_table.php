<?php

use yii\db\Migration;

/**
 * Handles adding show_on_page to table `know`.
 */
class m181218_100424_add_show_on_page_column_to_know_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('know', 'show_on_page', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('know', 'show_on_page');
    }
}
