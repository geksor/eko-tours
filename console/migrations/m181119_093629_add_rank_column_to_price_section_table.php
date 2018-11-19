<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `price_section`.
 */
class m181119_093629_add_rank_column_to_price_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('price_section', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('price_section', 'rank');
    }
}
