<?php

use yii\db\Migration;

/**
 * Handles adding image to table `accom`.
 */
class m181129_173233_add_image_column_to_accom_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('accom', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('accom', 'image');
    }
}
