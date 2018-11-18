<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accom".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $video_link
 * @property int $rank
 * @property int $publish
 * @property int $is_gallery
 *
 * @property Room[] $rooms
 */
class Accom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accom';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['rank', 'publish', 'is_gallery'], 'integer'],
            [['title', 'video_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'video_link' => 'Video Link',
            'rank' => 'Rank',
            'publish' => 'Publish',
            'is_gallery' => 'Is Gallery',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['accom_id' => 'id']);
    }
}
