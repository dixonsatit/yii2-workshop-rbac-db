<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $category
 * @property string $tag
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 */
class Blog extends \yii\db\ActiveRecord
{

    public function behaviors(){
      return [
        BlameableBehavior::className(),
        TimestampBehavior::className()
      ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['category', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title', 'tag'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'ชื่อเรื่อง'),
            'content' => Yii::t('app', 'เนื้อหา'),
            'category' => Yii::t('app', 'อาชีพ'),
            'tag' => Yii::t('app', 'ระบุ'),
            'created_at' => Yii::t('app', 'สร้างวันที่'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'แก้ไขวันที่'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }

    /**
     * @inheritdoc
     * @return BlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogQuery(get_called_class());
    }
}
