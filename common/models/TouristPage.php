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
class TouristPage extends Model
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
            'title' => 'Заголовок страницы (То что будет в H1)',
            'meta_title' => 'Title (То что будет в теге "< title >")',
            'meta_description' => 'Meta-description',
        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/tourist-page.json';
        file_put_contents($setPath , $tempParams);
    }
}