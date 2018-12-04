<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_attr`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 * - `attr`
 */
class m181204_044449_create_junction_table_for_tour_and_attr_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_attr', [
            'tour_id' => $this->integer(),
            'attr_id' => $this->integer(),
            'PRIMARY KEY(tour_id, attr_id)',
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-tour_attr-tour_id',
            'tour_attr',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-tour_attr-tour_id',
            'tour_attr',
            'tour_id',
            'tour',
            'id',
            'CASCADE'
        );

        // creates index for column `attr_id`
        $this->createIndex(
            'idx-tour_attr-attr_id',
            'tour_attr',
            'attr_id'
        );

        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-tour_attr-attr_id',
            'tour_attr',
            'attr_id',
            'attr',
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
            'fk-tour_attr-tour_id',
            'tour_attr'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-tour_attr-tour_id',
            'tour_attr'
        );

        // drops foreign key for table `attr`
        $this->dropForeignKey(
            'fk-tour_attr-attr_id',
            'tour_attr'
        );

        // drops index for column `attr_id`
        $this->dropIndex(
            'idx-tour_attr-attr_id',
            'tour_attr'
        );

        $this->dropTable('tour_attr');
    }
}
