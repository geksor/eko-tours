<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_period_rooms`.
 * Has foreign keys to the tables:
 *
 * - `tour_periods`
 * - `accom_rooms`
 */
class m200305_163053_create_tour_period_rooms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_period_rooms', [
            'id' => $this->primaryKey(),
            'period_id' => $this->integer()->notNull(),
            'room_id' => $this->integer()->notNull(),
            'price' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `period_id`
        $this->createIndex(
            'idx-tour_period_rooms-period_id',
            'tour_period_rooms',
            'period_id'
        );

        // add foreign key for table `tour_periods`
        $this->addForeignKey(
            'fk-tour_period_rooms-period_id',
            'tour_period_rooms',
            'period_id',
            'tour_periods',
            'id',
            'CASCADE'
        );

        // creates index for column `room_id`
        $this->createIndex(
            'idx-tour_period_rooms-room_id',
            'tour_period_rooms',
            'room_id'
        );

        // add foreign key for table `accom_rooms`
        $this->addForeignKey(
            'fk-tour_period_rooms-room_id',
            'tour_period_rooms',
            'room_id',
            'room',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-unique-period_id-room_id',
            'tour_period_rooms',
            'period_id, room_id',
            1
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `tour_periods`
        $this->dropForeignKey(
            'fk-tour_period_rooms-period_id',
            'tour_period_rooms'
        );

        // drops index for column `period_id`
        $this->dropIndex(
            'idx-tour_period_rooms-period_id',
            'tour_period_rooms'
        );

        // drops foreign key for table `accom_rooms`
        $this->dropForeignKey(
            'fk-tour_period_rooms-room_id',
            'tour_period_rooms'
        );

        // drops index for column `room_id`
        $this->dropIndex(
            'idx-tour_period_rooms-room_id',
            'tour_period_rooms'
        );

        $this->dropIndex(
            'idx-unique-period_id-room_id',
            'tour_period_rooms'
        );

        $this->dropTable('tour_period_rooms');
    }
}
