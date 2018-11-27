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
 *
 */
class TimetablePage extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;


    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',
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
            'title' => 'Заголовок страницы',
            'meta_title' => 'Meta-title',
            'meta_description' => 'Meta-description',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/timetable-page.json';
        file_put_contents($setPath , $tempParams);
    }
}