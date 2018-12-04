<?php

use yii\db\Migration;

/**
 * Handles dropping places from table `stage`.
 */
class m181204_080110_drop_places_column_from_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('stage', 'places_beads');
        $this->dropColumn('stage', 'places_lavender');
        $this->addColumn('stage', 'places', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('stage', 'places_beads', $this->integer());
        $this->addColumn('stage', 'places_lavender', $this->integer());
        $this->dropColumn('stage', 'places');
    }
}
