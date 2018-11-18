<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stage`.
 * Has foreign keys to the tables:
 *
 * - `month`
 */
class m181116_194502_create_stage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stage', [
            'id' => $this->primaryKey(),
            'month_id' => $this->integer()->notNull(),
            'start_date' => $this->integer(),
            'end_date' => $this->integer(),
            'places_beads' => $this->integer(),
            'places_lavender' => $this->integer(),
            'price' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `month_id`
        $this->createIndex(
            'idx-stage-month_id',
            'stage',
            'month_id'
        );

        // add foreign key for table `month`
        $this->addForeignKey(
            'fk-stage-month_id',
            'stage',
            'month_id',
            'month',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `month`
        $this->dropForeignKey(
            'fk-stage-month_id',
            'stage'
        );

        // drops index for column `month_id`
        $this->dropIndex(
            'idx-stage-month_id',
            'stage'
        );

        $this->dropTable('stage');
    }
}
