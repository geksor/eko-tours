<?php

use yii\db\Migration;

/**
 * Handles adding minPrice to table `tour`.
 */
class m181129_162521_add_minPrice_column_to_tour_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tour', 'min_price', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tour', 'min_price');
    }
}
