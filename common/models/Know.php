<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "know".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $image_count
 * @property int $rank
 *
 * @property TourKnow[] $tourKnows
 * @property Tour[] $tours
 */
class Know extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'know';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['image_count', 'rank'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 1],
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
            'text' => 'Text',
            'image_count' => 'Image Count',
            'rank' => 'Rank',
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
                'type' => 'know',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/know',
                'url' => '/uploads/images/know',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(490, 322));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 980;
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
    public function getTourKnows()
    {
        return $this->hasMany(TourKnow::className(), ['know_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tour::className(), ['id' => 'tour_id'])->viaTable('tour_know', ['know_id' => 'id']);
    }
}
