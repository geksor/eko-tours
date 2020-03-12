<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_periods`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 */
class m200305_162708_create_tour_periods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_periods', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer()->notNull(),
            'start' => $this->date(),
            'end' => $this->date(),
            'publish' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-tour_periods-tour_id',
            'tour_periods',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-tour_periods-tour_id',
            'tour_periods',
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
            'fk-tour_periods-tour_id',
            'tour_periods'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-tour_periods-tour_id',
            'tour_periods'
        );

        $this->dropTable('tour_periods');
    }
}
