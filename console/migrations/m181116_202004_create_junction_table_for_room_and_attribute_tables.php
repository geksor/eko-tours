<?php

use yii\db\Migration;

/**
 * Handles the creation of table `room_attribute`.
 * Has foreign keys to the tables:
 *
 * - `room`
 * - `attribute`
 */
class m181116_202004_create_junction_table_for_room_and_attribute_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('room_attribute', [
            'room_id' => $this->integer(),
            'attribute_id' => $this->integer(),
            'PRIMARY KEY(room_id, attribute_id)',
        ]);

        // creates index for column `room_id`
        $this->createIndex(
            'idx-room_attribute-room_id',
            'room_attribute',
            'room_id'
        );

        // add foreign key for table `room`
        $this->addForeignKey(
            'fk-room_attribute-room_id',
            'room_attribute',
            'room_id',
            'room',
            'id',
            'CASCADE'
        );

        // creates index for column `attribute_id`
        $this->createIndex(
            'idx-room_attribute-attribute_id',
            'room_attribute',
            'attribute_id'
        );

        // add foreign key for table `attribute`
        $this->addForeignKey(
            'fk-room_attribute-attribute_id',
            'room_attribute',
            'attribute_id',
            'attribute',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `room`
        $this->dropForeignKey(
            'fk-room_attribute-room_id',
            'room_attribute'
        );

        // drops index for column `room_id`
        $this->dropIndex(
            'idx-room_attribute-room_id',
            'room_attribute'
        );

        // drops foreign key for table `attribute`
        $this->dropForeignKey(
            'fk-room_attribute-attribute_id',
            'room_attribute'
        );

        // drops index for column `attribute_id`
        $this->dropIndex(
            'idx-room_attribute-attribute_id',
            'room_attribute'
        );

        $this->dropTable('room_attribute');
    }
}
