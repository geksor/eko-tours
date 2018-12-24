<?php
namespace frontend\widgets;

use common\models\Contact;
use yii\base\Widget;

class AgreeTextWidget extends Widget
{

    public function run()
    {
        $contact = new Contact();
        $contact->load(\Yii::$app->params);

        return $this->render('agree-text-widget', [
            'contact' => $contact,
        ]);
    }
}