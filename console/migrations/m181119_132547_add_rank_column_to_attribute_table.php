<?php

use yii\db\Migration;

/**
 * Handles adding rank to table `attribute`.
 */
class m181119_132547_add_rank_column_to_attribute_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('attribute', 'rank', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('attribute', 'rank');
    }
}
