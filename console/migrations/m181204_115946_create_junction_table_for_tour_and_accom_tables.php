<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_accom`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 * - `accom`
 */
class m181204_115946_create_junction_table_for_tour_and_accom_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_accom', [
            'tour_id' => $this->integer(),
            'accom_id' => $this->integer(),
            'PRIMARY KEY(tour_id, accom_id)',
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-tour_accom-tour_id',
            'tour_accom',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-tour_accom-tour_id',
            'tour_accom',
            'tour_id',
            'tour',
            'id',
            'CASCADE'
        );

        // creates index for column `accom_id`
        $this->createIndex(
            'idx-tour_accom-accom_id',
            'tour_accom',
            'accom_id'
        );

        // add foreign key for table `accom`
        $this->addForeignKey(
            'fk-tour_accom-accom_id',
            'tour_accom',
            'accom_id',
            'accom',
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
            'fk-tour_accom-tour_id',
            'tour_accom'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-tour_accom-tour_id',
            'tour_accom'
        );

        // drops foreign key for table `accom`
        $this->dropForeignKey(
            'fk-tour_accom-accom_id',
            'tour_accom'
        );

        // drops index for column `accom_id`
        $this->dropIndex(
            'idx-tour_accom-accom_id',
            'tour_accom'
        );

        $this->dropTable('tour_accom');
    }
}
