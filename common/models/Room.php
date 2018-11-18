<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $accom_id
 * @property string $title
 * @property int $rank
 * @property int $publish
 *
 * @property Accom $accom
 * @property RoomAttribute[] $roomAttributes
 * @property Attribute[] $attributes0
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accom_id', 'title'], 'required'],
            [['accom_id', 'rank', 'publish'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['accom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accom::className(), 'targetAttribute' => ['accom_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'accom_id' => 'Accom ID',
            'title' => 'Title',
            'rank' => 'Rank',
            'publish' => 'Publish',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccom()
    {
        return $this->hasOne(Accom::className(), ['id' => 'accom_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomAttributes()
    {
        return $this->hasMany(RoomAttribute::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('room_attribute', ['room_id' => 'id']);
    }
}
