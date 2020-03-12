<?php

use yii\db\Migration;

/**
 * Handles adding room_id to table `booking`.
 * Has foreign keys to the tables:
 *
 * - `room`
 */
class m200312_164535_add_room_id_column_to_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('booking', 'room_id', $this->integer());

        // creates index for column `room_id`
        $this->createIndex(
            'idx-booking-room_id',
            'booking',
            'room_id'
        );

        // add foreign key for table `room`
        $this->addForeignKey(
            'fk-booking-room_id',
            'booking',
            'room_id',
            'room',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `room`
        $this->dropForeignKey(
            'fk-booking-room_id',
            'booking'
        );

        // drops index for column `room_id`
        $this->dropIndex(
            'idx-booking-room_id',
            'booking'
        );

        $this->dropColumn('booking', 'room_id');
    }
}
