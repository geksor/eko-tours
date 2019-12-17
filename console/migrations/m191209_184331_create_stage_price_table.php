<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stage_price`.
 * Has foreign keys to the tables:
 *
 * - `stage`
 * - `accom`
 */
class m191209_184331_create_stage_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stage_price', [
            'id' => $this->primaryKey(),
            'stage_id' => $this->integer()->notNull(),
            'accom_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'description' => $this->string(),
            'place_count' => $this->integer(),
            'price' => $this->string(),
            'image' => $this->string(),
            'rank' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `stage_id`
        $this->createIndex(
            'idx-stage_price-stage_id',
            'stage_price',
            'stage_id'
        );

        // add foreign key for table `stage`
        $this->addForeignKey(
            'fk-stage_price-stage_id',
            'stage_price',
            'stage_id',
            'stage',
            'id',
            'CASCADE'
        );

        // creates index for column `accom_id`
        $this->createIndex(
            'idx-stage_price-accom_id',
            'stage_price',
            'accom_id'
        );

        // add foreign key for table `accom`
        $this->addForeignKey(
            'fk-stage_price-accom_id',
            'stage_price',
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
        // drops foreign key for table `stage`
        $this->dropForeignKey(
            'fk-stage_price-stage_id',
            'stage_price'
        );

        // drops index for column `stage_id`
        $this->dropIndex(
            'idx-stage_price-stage_id',
            'stage_price'
        );

        // drops foreign key for table `accom`
        $this->dropForeignKey(
            'fk-stage_price-accom_id',
            'stage_price'
        );

        // drops index for column `accom_id`
        $this->dropIndex(
            'idx-stage_price-accom_id',
            'stage_price'
        );

        $this->dropTable('stage_price');
    }
}
