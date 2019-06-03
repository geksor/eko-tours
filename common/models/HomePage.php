<?php

namespace common\models;

use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $title
 * @property string $meta_title
 * @property string $meta_description
 *
 * @property string $headerTitle
 * @property string $item_1
 * @property string $item_2
 * @property string $item_3
 *
 * @property string $text
 * @property int $gallery_id
 * @property string $rightBlock_title
 * @property string $rightBlock_text
 *
 * @property string $instagramm
 *
 */
class HomePage extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;

    public $headerTitle;
    public $item_1;
    public $item_2;
    public $item_3;

    public $text;
    public $gallery_id;
    public $rightBlock_title;
    public $rightBlock_text;

    public $instagram;



    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',

                    'headerTitle',
                    'item_1',
                    'item_2',
                    'item_3',

                    'text',
                    'gallery_id',
                    'rightBlock_title',
                    'rightBlock_text',

                    'instagram',
                ],
                'safe'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок страницы (То что будет в H1)',
            'meta_title' => 'Title (То что будет в теге "< title >")',
            'meta_description' => 'Meta-description',

            'headerTitle' => 'Заголовок в шапке сайта',
            'item_1' => 'Блок 1 в шапке сайта',
            'item_2' => 'Блок 2 в шапке сайта',
            'item_3' => 'Блок 3 в шапке сайта',

            'text' => 'Текст о нас',
            'gallery_id' => 'Галерея в раздел о нас',
            'rightBlock_title' => 'Заголовок правого блока о нас',
            'rightBlock_text' => 'Содержание правого блока о нас',

            'instagram' => 'Аккаунт инстаграма для виджета',
        ];
    }

    public static function getGalleryDropDown()
    {
        return ArrayHelper::map(Gallery::find()->asArray()->all(), 'id', 'title');
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/home-page.json';
        file_put_contents($setPath , $tempParams);
    }
}