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
            'confirm' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'done_at' => $this->integer(),
            'viewed' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('booking');
    }
}
