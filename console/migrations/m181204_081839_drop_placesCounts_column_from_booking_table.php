<?php

use yii\db\Migration;

/**
 * Handles dropping placesCounts from table `booking`.
 */
class m181204_081839_drop_placesCounts_column_from_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('booking', 'places_count_beads');
        $this->dropColumn('booking', 'places_count_lavender');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('booking', 'places_count_beads', $this->integer());
        $this->addColumn('booking', 'places_count_lavender', $this->integer());
    }
}
