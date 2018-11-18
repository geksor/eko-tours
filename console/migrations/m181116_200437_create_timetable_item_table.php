<?php

use yii\db\Migration;

/**
 * Handles the creation of table `timetable_item`.
 * Has foreign keys to the tables:
 *
 * - `timetable_day`
 */
class m181116_200437_create_timetable_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('timetable_item', [
            'id' => $this->primaryKey(),
            'timetable_day_id' => $this->integer()->notNull(),
            'start_time' => $this->integer()->notNull(),
            'end_time' => $this->integer()->defaultValue(null),
            'text' => $this->text(),
            'publish' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `timetable_day_id`
        $this->createIndex(
            'idx-timetable_item-timetable_day_id',
            'timetable_item',
            'timetable_day_id'
        );

        // add foreign key for table `timetable_day`
        $this->addForeignKey(
            'fk-timetable_item-timetable_day_id',
            'timetable_item',
            'timetable_day_id',
            'timetable_day',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `timetable_day`
        $this->dropForeignKey(
            'fk-timetable_item-timetable_day_id',
            'timetable_item'
        );

        // drops index for column `timetable_day_id`
        $this->dropIndex(
            'idx-timetable_item-timetable_day_id',
            'timetable_item'
        );

        $this->dropTable('timetable_item');
    }
}
