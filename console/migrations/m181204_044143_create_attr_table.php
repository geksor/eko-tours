<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attr`.
 * Has foreign keys to the tables:
 *
 * - `attr_group`
 */
class m181204_044143_create_attr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attr', [
            'id' => $this->primaryKey(),
            'attr_group_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'rank' => $this->integer(),
        ]);

        // creates index for column `attr_group_id`
        $this->createIndex(
            'idx-attr-attr_group_id',
            'attr',
            'attr_group_id'
        );

        // add foreign key for table `attr_group`
        $this->addForeignKey(
            'fk-attr-attr_group_id',
            'attr',
            'attr_group_id',
            'attr_group',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `attr_group`
        $this->dropForeignKey(
            'fk-attr-attr_group_id',
            'attr'
        );

        // drops index for column `attr_group_id`
        $this->dropIndex(
            'idx-attr-attr_group_id',
            'attr'
        );

        $this->dropTable('attr');
    }
}
