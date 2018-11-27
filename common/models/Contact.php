<?php

namespace common\models;

use yii\base\Model;
use Yii;

/**
 * Class Contact
 * @package backend\models
 *
 * @property string $title
 * @property string $meta_title
 * @property string $meta_description
 *
 * @property string $email
 * @property string $phone
 * @property string $address_beads
 * @property string $address_lavender
 * @property string $mapScript
 * @property string $field
 *
 * @property string $company_name
 * @property string $corpAddress
 * @property string $inn
 * @property string $kpp
 * @property string $ogrn
 *
 * @property string $insta
 * @property string $vk
 *
 * @property int $chatId
 */
class Contact extends Model
{
    public $title;
    public $meta_title;
    public $meta_description;

    public $email;
    public $phone;
    public $address_beads;
    public $address_lavender;
    public $mapScript;

    public $company_name;
    public $corpAddress;
    public $inn;
    public $kpp;
    public $ogrn;
    public $field;

    public $insta;
    public $vk;

    public $chatId;



    public function rules()
    {
        return [
            [
                [
                    'title',
                    'meta_title',
                    'meta_description',

                    'email',
                    'phone',
                    'address_beads',
                    'address_lavender',
                    'mapScript',

                    'company_name',
                    'corpAddress',
                    'inn',
                    'kpp',
                    'ogrn',
                    'field',

                    'insta',
                    'vk',

                    'chatId',
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

            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address_beads' => 'Адрес рябиновые бусы',
            'address_lavender' => 'Адрес лаванда',
            'mapScript' => 'Код карты',

            'company_name' => 'Название фирмы',
            'corpAddress' => 'Юридический адрес',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'ogrn' => 'ОГРН',
            'field' => 'Сфера туроператорской деятельности',

            'insta' => 'Инстаграмм',
            'vk' => 'Вконтакте',

            'chatId' => 'ID чата телеграмм',

        ];
    }

    public function save($request){
        if ($request){
            $tempParams = json_encode($request);
        }else{
            $tempParams = '{}';
        }
        $setPath = dirname(dirname(__DIR__)).'/common/config/contact.json';
        file_put_contents($setPath , $tempParams);
    }
}