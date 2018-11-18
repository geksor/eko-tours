<?php

use yii\db\Migration;

/**
 * Handles the creation of table `timetable_day`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 */
class m181116_200219_create_timetable_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('timetable_day', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer()->notNull(),
            'day_number' => $this->integer(),
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-timetable_day-tour_id',
            'timetable_day',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-timetable_day-tour_id',
            'timetable_day',
            'tour_id',
            'tour',
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
            'fk-timetable_day-tour_id',
            'timetable_day'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-timetable_day-tour_id',
            'timetable_day'
        );

        $this->dropTable('timetable_day');
    }
}
