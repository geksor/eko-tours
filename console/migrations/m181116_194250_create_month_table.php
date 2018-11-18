<?php

use yii\db\Migration;

/**
 * Handles the creation of table `month`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 */
class m181116_194250_create_month_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('month', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer()->notNull(),
            'title' => $this->integer(),
            'image' => $this->string(),
            'publish' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-month-tour_id',
            'month',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-month-tour_id',
            'month',
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
        // drops foreign key for table `tour`
        $this->dropForeignKey(
            'fk-month-tour_id',
            'month'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-month-tour_id',
            'month'
        );

        $this->dropTable('month');
    }
}
