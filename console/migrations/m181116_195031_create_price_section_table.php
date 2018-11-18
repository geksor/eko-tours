<?php

use yii\db\Migration;

/**
 * Handles the creation of table `price_section`.
 */
class m181116_195031_create_price_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('price_section', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('price_section');
    }
}
