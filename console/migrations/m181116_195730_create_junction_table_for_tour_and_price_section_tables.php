<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_price_section`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 * - `price_section`
 */
class m181116_195730_create_junction_table_for_tour_and_price_section_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_price_section', [
            'tour_id' => $this->integer(),
            'price_section_id' => $this->integer(),
            'PRIMARY KEY(tour_id, price_section_id)',
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-tour_price_section-tour_id',
            'tour_price_section',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-tour_price_section-tour_id',
            'tour_price_section',
            'tour_id',
            'tour',
            'id',
            'CASCADE'
        );

        // creates index for column `price_section_id`
        $this->createIndex(
            'idx-tour_price_section-price_section_id',
            'tour_price_section',
            'price_section_id'
        );

        // add foreign key for table `price_section`
        $this->addForeignKey(
            'fk-tour_price_section-price_section_id',
            'tour_price_section',
            'price_section_id',
            'price_section',
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
            'fk-tour_price_section-tour_id',
            'tour_price_section'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-tour_price_section-tour_id',
            'tour_price_section'
        );

        // drops foreign key for table `price_section`
        $this->dropForeignKey(
            'fk-tour_price_section-price_section_id',
            'tour_price_section'
        );

        // drops index for column `price_section_id`
        $this->dropIndex(
            'idx-tour_price_section-price_section_id',
            'tour_price_section'
        );

        $this->dropTable('tour_price_section');
    }
}
