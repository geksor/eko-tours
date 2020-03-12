<?php

use yii\db\Migration;

/**
 * Handles adding period_id to table `booking`.
 * Has foreign keys to the tables:
 *
 * - `period`
 */
class m200311_200933_add_tour_period_room_id_column_to_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('booking', 'tour_period_room_id', $this->integer());

        // creates index for column `tour_period_room_id`
        $this->createIndex(
            'idx-booking-tour_period_room_id',
            'booking',
            'tour_period_room_id'
        );

        // add foreign key for table `tour_period_rooms`
        $this->addForeignKey(
            'fk-booking-tour_period_room_id',
            'booking',
            'tour_period_room_id',
            'tour_period_rooms',
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
            'fk-booking-tour_period_room_id',
            'booking'
        );

        // drops index for column `period_id`
        $this->dropIndex(
            'idx-booking-tour_period_room_id',
            'booking'
        );

        $this->dropColumn('booking', 'tour_period_room_id');
    }
}
