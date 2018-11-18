<?php

use yii\db\Migration;

/**
 * Handles the creation of table `room`.
 * Has foreign keys to the tables:
 *
 * - `accom`
 */
class m181116_201328_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('room', [
            'id' => $this->primaryKey(),
            'accom_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'rank' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),

        ]);

        // creates index for column `accom_id`
        $this->createIndex(
            'idx-room-accom_id',
            'room',
            'accom_id'
        );

        // add foreign key for table `accom`
        $this->addForeignKey(
            'fk-room-accom_id',
            'room',
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
        // drops foreign key for table `accom`
        $this->dropForeignKey(
            'fk-room-accom_id',
            'room'
        );

        // drops index for column `accom_id`
        $this->dropIndex(
            'idx-room-accom_id',
            'room'
        );

        $this->dropTable('room');
    }
}
