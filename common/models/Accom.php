<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

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
     * @return array
     */
    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'accom',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/accom',
                'url' => '/uploads/images/accom',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(381, 286));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 1024;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
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
