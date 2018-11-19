<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `price_item`.
 */
class m181119_093828_add_rank_column_to_price_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('price_item', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('price_item', 'rank');
    }
}
