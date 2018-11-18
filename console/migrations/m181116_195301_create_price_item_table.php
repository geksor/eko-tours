<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_item`.
 * Has foreign keys to the tables:
 *
 * - `price_section`
 */
class m181116_195301_create_price_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('price_item', [
            'id' => $this->primaryKey(),
            'price_section_id' => $this->integer()->notNull(),
            'text' =>$this->text(),
        ]);

        // creates index for column `price_section_id`
        $this->createIndex(
            'idx-price_item-price_section_id',
            'price_item',
            'price_section_id'
        );

        // add foreign key for table `price_section`
        $this->addForeignKey(
            'fk-price_item-price_section_id',
            'price_item',
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
        // drops foreign key for table `price_section`
        $this->dropForeignKey(
            'fk-price_item-price_section_id',
            'price_item'
        );

        // drops index for column `price_section_id`
        $this->dropIndex(
            'idx-price_item-price_section_id',
            'price_item'
        );

        $this->dropTable('price_item');
    }
}
