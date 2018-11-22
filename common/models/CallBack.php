<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "call_back".
 *
 * @property int $id
 * @property string $user_name
 * @property string $phone
 * @property int $is_consult
 * @property int $created_at
 * @property int $done_at
 * @property int $viewed
 */
class CallBack extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'call_back';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_consult', 'created_at', 'done_at', 'viewed'], 'integer'],
            [['user_name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'phone' => 'Phone',
            'is_consult' => 'Is Consult',
            'created_at' => 'Created At',
            'done_at' => 'Done At',
            'viewed' => 'Viewed',
        ];
    }
}
