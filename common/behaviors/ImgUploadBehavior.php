<?php
/**
 * Created by PhpStorm.
 * User: geksor
 * Date: 16.08.2018
 * Time: 13:32
 */

namespace common\behaviors;


use common\models\ImageUpload;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * This is the model class ImgUploadBehavior.
 *
 * @property $propImage
 * @property $noImage
 * @property $folder
 *
 */

class ImgUploadBehavior extends Behavior
{
    public $propImage;
    public $noImage;
    public $folder;


    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }
    /**
     * @param $fileName
     * @return bool
     */
    public function savePhoto($fileName)
    {
        $image = $this->propImage;
        $this->owner->$image = $fileName;

        return $this->owner->save(false);
    }

    /**
     * @return string
     */
    public function getImageIsSet()
    {
        $image = $this->propImage;
        return ($this->owner->$image) ? true : false;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $image = $this->propImage;
        return ($this->owner->$image) ? $this->folder . '/' . $this->owner->$image : "/$this->noImage";
    }

    /**
     * @return string
     */
    public function getThumbImage()
    {
        $image = $this->propImage;
        return ($this->owner->$image) ? $this->folder . '/' . 'thumb_' . $this->owner->$image : "/$this->noImage";
    }

    /**
     * @throws \yii\base\Exception
     */
    public function deletePhoto()
    {
        $imageUploadModel = new ImageUpload();

        $image = $this->propImage;
        $imageUploadModel->deleteCurrentImage($this->owner->$image);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function beforeDelete()
    {
        $this->deletePhoto();
    }
}