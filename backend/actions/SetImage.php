<?php
/**
 * Created by PhpStorm.
 * User: Geksor
 * Date: 17.11.2018
 * Time: 20:42
 */

namespace backend\actions;


use common\models\ImageUpload;
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;

/**
 * Class SetImage
 * @package backend\actions
 *
 * @property string $folder
 * @property string $propImage
 * @property string $title
 * @property string $width
 * @property string $height
 */

class SetImage extends Action
{
    public $folder;
    public $propImage;
    public $title;
    public $width;
    public $height;

    public function run($id)
    {
        $model = new ImageUpload();
        $imageFrom = $this->controller->findModel($id);

        if (Yii::$app->request->isPost && Yii::$app->request->post('ImageUpload')['crop_info'])
        {
            $file = UploadedFile::getInstance($model, 'image');
            $cropInfo = Yii::$app->request->post('ImageUpload')['crop_info'];
            $image = $this->propImage;

            if ($imageFrom->savePhoto($model->uploadFile($file, $imageFrom->$image, $cropInfo, $this->folder)))
            {
                return $this->controller->redirect(['view', 'id' => $imageFrom->id]);
            }
        }

        return $this->controller->render('@backend/actions/views/set-photo', [
            'model' => $model,
            'imageFrom' => $imageFrom,
            'title' => $this->title,
            'width' => $this->width,
            'height' => $this->height,
        ]);
    }
}