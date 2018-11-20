<?php

use yii\db\Migration;

/**
 * Handles adding viewed to table `reviews`.
 */
class m181119_184215_add_viewed_column_to_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reviews', 'viewed', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('reviews', 'viewed');
    }
}
