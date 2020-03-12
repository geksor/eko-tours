<?php

use yii\db\Migration;

/**
 * Handles adding period_id to table `booking`.
 * Has foreign keys to the tables:
 *
 * - `period`
 */
class m200312_164550_add_period_id_column_to_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('booking', 'period_id', $this->integer());

        // creates index for column `period_id`
        $this->createIndex(
            'idx-booking-period_id',
            'booking',
            'period_id'
        );

        // add foreign key for table `period`
        $this->addForeignKey(
            'fk-booking-period_id',
            'booking',
            'period_id',
            'period',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `period`
        $this->dropForeignKey(
            'fk-booking-period_id',
            'booking'
        );

        // drops index for column `period_id`
        $this->dropIndex(
            'idx-booking-period_id',
            'booking'
        );

        $this->dropColumn('booking', 'period_id');
    }
}
