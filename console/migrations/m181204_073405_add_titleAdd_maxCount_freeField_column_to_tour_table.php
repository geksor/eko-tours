<?php

use yii\db\Migration;

/**
 * Handles adding titleAdd_maxCount_freeField to table `tour`.
 */
class m181204_073405_add_titleAdd_maxCount_freeField_column_to_tour_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tour', 'title_add', $this->string());
        $this->addColumn('tour', 'max_count', $this->integer());
        $this->addColumn('tour', 'free_field', $this->string());
        $this->addColumn('tour', 'show_on_home', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tour', 'title_add');
        $this->dropColumn('tour', 'max_count');
        $this->dropColumn('tour', 'free_field');
        $this->dropColumn('tour', 'show_on_home');
    }
}
