<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attr_group".
 *
 * @property int $id
 * @property string $title
 * @property int $rank
 *
 * @property Attr[] $attrs
 */
class AttrGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attr_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['rank'], 'default', 'value' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'rank' => 'Порядок вывода',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrs()
    {
        return $this->hasMany(Attr::className(), ['attr_group_id' => 'id']);
    }
}
