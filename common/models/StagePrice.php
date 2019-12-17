<?php

namespace common\models;

use common\behaviors\ImgUploadBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stage_price".
 *
 * @property int $id
 * @property int $stage_id
 * @property int $accom_id
 * @property string $title
 * @property string $description
 * @property int $place_count
 * @property int $price
 * @property string $image
 * @property int $rank
 * @property int $publish
 *
 * @property Accom $accom
 * @property Stage $stage
 */
class StagePrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stage_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stage_id', 'accom_id'], 'required'],
            [['stage_id', 'accom_id', 'place_count', 'rank', 'publish'], 'integer'],
            [['rank'], 'default', 'value' => 100],
            [['title', 'description', 'price', 'image'], 'string', 'max' => 255],
            [['accom_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accom::className(), 'targetAttribute' => ['accom_id' => 'id']],
            [['stage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stage::className(), 'targetAttribute' => ['stage_id' => 'id']],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'ImgUploadBehavior' => [
                'class' => ImgUploadBehavior::className(),
                'noImage' => 'no_image.png',
                'folder' => '/uploads/images/stage_price_image',
                'propImage' => 'image',
            ],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stage_id' => 'Поток',
            'accom_id' => 'Гостевой дом',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'place_count' => 'Количество мест',
            'price' => 'Цена',
            'image' => 'Изображение',
            'rank' => 'Порядок вывода',
            'publish' => 'Публикация',
        ];
    }

    public static function getAccomListToForm()
    {
        $modelsArr = Accom::find()->where(['publish' => 1])->asArray()->all();

        return ArrayHelper::map($modelsArr, 'id', 'title');
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
    public function getStage()
    {
        return $this->hasOne(Stage::className(), ['id' => 'stage_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\StagePriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\StagePriceQuery(get_called_class());
    }
}
