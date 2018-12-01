<?php

use yii\db\Migration;

/**
 * Handles adding placesCount to table `tour`.
 */
class m181201_082853_add_placesCount_column_to_tour_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tour', 'places_count', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tour', 'places_count');
    }
}
