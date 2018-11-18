<?php

use yii\db\Migration;

/**
 * Handles the creation of table `booking`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 * - `month`
 * - `stage`
 */
class m181116_204248_create_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('booking', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer(),
            'month_id' => $this->integer(),
            'stage_id' => $this->integer(),
            'places_count_beads' => $this->integer(),
            'places_count_lavender' => $this->integer(),
            'user_places_count' => $this->integer(),
            'total_price' => $this->integer(),
            'customer_name' => $this->string()->notNull(),
            'customer_phone' => $this->string()->notNull(),
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-booking-tour_id',
            'booking',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-booking-tour_id',
            'booking',
            'tour_id',
            'tour',
            'id',
            'CASCADE'
        );

        // creates index for column `month_id`
        $this->createIndex(
            'idx-booking-month_id',
            'booking',
            'month_id'
        );

        // add foreign key for table `month`
        $this->addForeignKey(
            'fk-booking-month_id',
            'booking',
            'month_id',
            'month',
            'id',
            'CASCADE'
        );

        // creates index for column `stage_id`
        $this->createIndex(
            'idx-booking-stage_id',
            'booking',
            'stage_id'
        );

        // add foreign key for table `stage`
        $this->addForeignKey(
            'fk-booking-stage_id',
            'booking',
            'stage_id',
            'stage',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `tour`
        $this->dropForeignKey(
            'fk-booking-tour_id',
            'booking'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-booking-tour_id',
            'booking'
        );

        // drops foreign key for table `month`
        $this->dropForeignKey(
            'fk-booking-month_id',
            'booking'
        );

        // drops index for column `month_id`
        $this->dropIndex(
            'idx-booking-month_id',
            'booking'
        );

        // drops foreign key for table `stage`
        $this->dropForeignKey(
            'fk-booking-stage_id',
            'booking'
        );

        // drops index for column `stage_id`
        $this->dropIndex(
            'idx-booking-stage_id',
            'booking'
        );

        $this->dropTable('booking');
    }
}
