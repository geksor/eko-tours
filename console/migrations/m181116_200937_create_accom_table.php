<?php

use yii\db\Migration;

/**
 * Handles the creation of table `accom`.
 */
class m181116_200937_create_accom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('accom', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'video_link' => $this->string(),
            'rank' => $this->integer(),
            'publish' => $this->integer()->defaultValue(0),
            'is_gallery' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('accom');
    }
}
