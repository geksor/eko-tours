<?php

namespace common\models;

use common\behaviors\ImgUploadBehavior;
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
 * @property string $image
 *
 * @property Room[] $rooms
 * @property TourAccom[] $tourAccoms
 * @property Tour[] $tours
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
            [['title', 'video_link', 'image',], 'string', 'max' => 255],
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
            'description' => 'Описание',
            'video_link' => 'Ссылка на видео',
            'rank' => 'Порядок вывода',
            'publish' => 'Публикация',
            'is_gallery' => 'В виде галереи',
            'image' => 'Изображение',
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
            'ImgUploadBehavior' => [
                'class' => ImgUploadBehavior::className(),
                'noImage' => 'no_image.png',
                'folder' => '/uploads/images/accoms',
                'propImage' => 'image',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTourAccoms()
    {
        return $this->hasMany(TourAccom::className(), ['accom_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('tour_accom', ['accom_id' => 'id']);
    }
}
