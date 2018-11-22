<?php

namespace common\models;

use Imagine\Image\ImageInterface;
use Yii;
use yii\helpers\ArrayHelper;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int $accom_id
 * @property string $title
 * @property int $rank
 * @property int $publish
 * @property array $attrs
 *
 * @property Accom $accom
 * @property RoomAttribute[] $roomAttributes
 * @property Attribute[] $attributes0
 */
class Room extends \yii\db\ActiveRecord
{
    public $attrs = [];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    public function afterFind()
    {
        $this->attrs = $this->getSelectedAttr();
        parent::afterFind();
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accom_id', 'title'], 'required'],
            [['attrs'], 'safe'],
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
     * @return array
     */
    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'room',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/room',
                'url' => '/uploads/images/room',
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(800, 416));
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

    /**
     * @param $attrs array ([0 => $attrs_id, 1 => s, ...])
     */
    public function saveRoomAttr($attrs)
    {
        RoomAttribute::deleteAll(['room_id' => $this->id]);
        if (is_array($attrs))
        {
            foreach ($attrs as $attr_id)
            {
                $attrModel = Attribute::findOne($attr_id);
                $this->link('attributes0', $attrModel);
            }
        }
    }

    /**
     * @return array
     */
    public function getSelectedAttr()
    {
        $selectedAttributes = $this->getAttributes0()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedAttributes, 'id');
    }

}
