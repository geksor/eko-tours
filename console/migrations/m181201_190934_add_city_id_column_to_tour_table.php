<?php

use yii\db\Migration;

/**
 * Handles adding city_id to table `tour`.
 * Has foreign keys to the tables:
 *
 * - `city`
 */
class m181201_190934_add_city_id_column_to_tour_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tour', 'city_id', $this->integer());

        // creates index for column `city_id`
        $this->createIndex(
            'idx-tour-city_id',
            'tour',
            'city_id'
        );

        // add foreign key for table `city`
        $this->addForeignKey(
            'fk-tour-city_id',
            'tour',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `city`
        $this->dropForeignKey(
            'fk-tour-city_id',
            'tour'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            'idx-tour-city_id',
            'tour'
        );

        $this->dropColumn('tour', 'city_id');
    }
}
