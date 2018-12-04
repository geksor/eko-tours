<?php

namespace common\models;

use common\behaviors\ImgUploadBehavior;
use Yii;

/**
 * This is the model class for table "attribute".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property int $rank
 *
 * @property RoomAttribute[] $roomAttributes
 * @property Room[] $rooms
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'image' => 'Изображение',
            'rank' => 'Порядок вывода',
        ];
    }

    public function behaviors()
    {
        return [
            'ImgUploadBehavior' => [
                'class' => ImgUploadBehavior::className(),
                'noImage' => 'no_image.png',
                'folder' => '/uploads/images/attribute',
                'propImage' => 'image',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomAttributes()
    {
        return $this->hasMany(RoomAttribute::className(), ['attribute_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id' => 'room_id'])->viaTable('room_attribute', ['attribute_id' => 'id']);
    }
}
