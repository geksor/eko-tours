<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_tour`.
 * Has foreign keys to the tables:
 *
 * - `category`
 * - `tour`
 */
class m190604_180127_create_junction_table_for_category_and_tour_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_tour', [
            'category_id' => $this->integer(),
            'tour_id' => $this->integer(),
            'PRIMARY KEY(category_id, tour_id)',
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_tour-category_id',
            'category_tour',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_tour-category_id',
            'category_tour',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-category_tour-tour_id',
            'category_tour',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-category_tour-tour_id',
            'category_tour',
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
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-category_tour-category_id',
            'category_tour'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-category_tour-category_id',
            'category_tour'
        );

        // drops foreign key for table `tour`
        $this->dropForeignKey(
            'fk-category_tour-tour_id',
            'category_tour'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-category_tour-tour_id',
            'category_tour'
        );

        $this->dropTable('category_tour');
    }
}
