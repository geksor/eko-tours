<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tour_price_item`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 * - `price_item`
 */
class m181116_195903_create_junction_table_for_tour_and_price_item_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tour_price_item', [
            'tour_id' => $this->integer(),
            'price_item_id' => $this->integer(),
            'value' => $this->string(),
            'PRIMARY KEY(tour_id, price_item_id)',
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-tour_price_item-tour_id',
            'tour_price_item',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-tour_price_item-tour_id',
            'tour_price_item',
            'tour_id',
            'tour',
            'id',
            'CASCADE'
        );

        // creates index for column `price_item_id`
        $this->createIndex(
            'idx-tour_price_item-price_item_id',
            'tour_price_item',
            'price_item_id'
        );

        // add foreign key for table `price_item`
        $this->addForeignKey(
            'fk-tour_price_item-price_item_id',
            'tour_price_item',
            'price_item_id',
            'price_item',
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
            'fk-tour_price_item-tour_id',
            'tour_price_item'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-tour_price_item-tour_id',
            'tour_price_item'
        );

        // drops foreign key for table `price_item`
        $this->dropForeignKey(
            'fk-tour_price_item-price_item_id',
            'tour_price_item'
        );

        // drops index for column `price_item_id`
        $this->dropIndex(
            'idx-tour_price_item-price_item_id',
            'tour_price_item'
        );

        $this->dropTable('tour_price_item');
    }
}
