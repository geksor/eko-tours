<?php

namespace common\models;

use yii\base\Model;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $title
 * @property string $meta_title
 * @property string $meta_description
 * @property string $aboutText
 *
 * @property string $monday
 * @property string $tuesday
 * @property string $wednesday
 * @property string $thursday
 * @property string $friday
 * @property string $saturday
 * @property string $sunday
 *
 */
class AboutPage extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;
    public $aboutText;

    public $monday;
    public $tuesday;
    public $wednesday;
    public $thursday;
    public $friday;
    public $saturday;
    public $sunday;


    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',
                    'aboutText',
                    'monday',
                    'tuesday',
                    'wednesday',
                    'thursday',
                    'friday',
                    'saturday',
                    'sunday',
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
            'aboutText' => 'Тест о нас',
            'monday' => 'Понедельник',
            'tuesday' => 'Вторник',
            'wednesday' => 'Среда',
            'thursday' => 'Четверг',
            'friday' => 'Пятница',
            'saturday' => 'Суббота',
            'sunday' => 'Воскрксенье',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/about-page.json';
        file_put_contents($setPath , $tempParams);
    }
}