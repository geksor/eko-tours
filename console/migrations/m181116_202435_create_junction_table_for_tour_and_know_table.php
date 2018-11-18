<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_know`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 * - `know`
 */
class m181116_202435_create_junction_table_for_tour_and_know_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_know', [
            'tour_id' => $this->integer(),
            'know_id' => $this->integer(),
            'PRIMARY KEY(tour_id, know_id)',
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-tour_know-tour_id',
            'tour_know',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-tour_know-tour_id',
            'tour_know',
            'tour_id',
            'tour',
            'id',
            'CASCADE'
        );

        // creates index for column `know_id`
        $this->createIndex(
            'idx-tour_know-know_id',
            'tour_know',
            'know_id'
        );

        // add foreign key for table `know`
        $this->addForeignKey(
            'fk-tour_know-know_id',
            'tour_know',
            'know_id',
            'know',
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
            'fk-tour_know-tour_id',
            'tour_know'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-tour_know-tour_id',
            'tour_know'
        );

        // drops foreign key for table `know`
        $this->dropForeignKey(
            'fk-tour_know-know_id',
            'tour_know'
        );

        // drops index for column `know_id`
        $this->dropIndex(
            'idx-tour_know-know_id',
            'tour_know'
        );

        $this->dropTable('tour_know');
    }
}
