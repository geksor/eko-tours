<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reviews`.
 * Has foreign keys to the tables:
 *
 * - `tour`
 */
class m181116_202933_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'tour_id' => $this->integer()->defaultValue(null),
            'user_name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'create_at' => $this->integer(),
            'done_at' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
            'from_widget' => $this->integer()->defaultValue(0),
            'rank' => $this->integer(),
        ]);

        // creates index for column `tour_id`
        $this->createIndex(
            'idx-reviews-tour_id',
            'reviews',
            'tour_id'
        );

        // add foreign key for table `tour`
        $this->addForeignKey(
            'fk-reviews-tour_id',
            'reviews',
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
            'fk-reviews-tour_id',
            'reviews'
        );

        // drops index for column `tour_id`
        $this->dropIndex(
            'idx-reviews-tour_id',
            'reviews'
        );

        $this->dropTable('reviews');
    }
}
