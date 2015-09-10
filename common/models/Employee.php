<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $surname
 * @property string $gender
 * @property string $birthday
 * @property integer $height
 * @property integer $weight
 * @property string $blood_type
 * @property string $ceallphone
 * @property string $personal_id
 * @property string $photo
 * @property integer $nationality
 * @property integer $race
 * @property integer $religion
 * @property string $skill
 * @property double $salary
 * @property integer $department_id
 * @property integer $user_id
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_by
 * @property integer $updated_at
 */
class Employee extends \yii\db\ActiveRecord
{

    public function behaviors(){
      return [
        TimestampBehavior::className(),
        BlameableBehavior::className()
      ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','name','surname','gender','birthday','blood_type','ceallphone','personal_id'], 'required'],
            [['gender'], 'string'],
            [['birthday'], 'safe'],
            [['height', 'weight', 'nationality', 'race', 'religion', 'department_id', 'user_id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['salary'], 'number'],
            [['title'], 'string', 'max' => 100],
            [['name', 'surname'], 'string', 'max' => 150],
            [['blood_type'], 'string', 'max' => 10],
            [['ceallphone'], 'string', 'max' => 15],
            [['personal_id'], 'string', 'max' => 18],
            [['photo'], 'string', 'max' => 120],
            [['skill'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'ชื่อผู้ใช้งาน'),
            'email' => Yii::t('app', 'อีเมล์'),
            'fullname' => Yii::t('app', 'ชื่อ-นามสกุล'),
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'คำนำหน้า'),
            'name' => Yii::t('app', 'ชื่อ'),
            'surname' => Yii::t('app', 'นามสกุล'),
            'gender' => Yii::t('app', 'เพศ'),
            'genderName' => Yii::t('app', 'เพศ'),
            'birthday' => Yii::t('app', 'วันเกิด'),
            'height' => Yii::t('app', 'ส่วนสูง'),
            'weight' => Yii::t('app', 'น้ำหนัก'),
            'blood_type' => Yii::t('app', 'กรุ๊ฟเลือด'),
            'ceallphone' => Yii::t('app', 'เบอร์โทร'),
            'personal_id' => Yii::t('app', 'หมายเลขบัตรประชาชน'),
            'photo' => Yii::t('app', 'ภาพถ่าย'),
            'nationality' => Yii::t('app', 'สัญชาติ'),
            'race' => Yii::t('app', 'เชื้อชาติ'),
            'religion' => Yii::t('app', 'ศาสนา'),
            'skill' => Yii::t('app', 'ทักษะ'),
            'salary' => Yii::t('app', 'เงินเดือน'),
            'department_id' => Yii::t('app', 'แผนก'),
            'user_id' => Yii::t('app', 'รหัส account พนักงาน'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'created_at' => Yii::t('app', 'สร้างวันที่'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
            'updated_at' => Yii::t('app', 'แก้ไขวันที่'),
        ];
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }

    public function itemAilas($type){
      $items = [
        'gender'=>[
            'm'=>'ชาย',
            'w'=>'หญิง'
        ]
      ];
      return array_key_exists($type, $items) ? $items[$type] : [];
    }

    public function getLabelFromKey($type,$value,$emptyText=null){
      $items =  $this->itemAilas($type);
      return array_key_exists($value, $items) ? $items[$value] : $emptyText;
    }

    public function getItemGender(){
      return $this->itemAilas('gender');
    }

    public function getGenderName(){
      return $this->getLabelFromKey('gender',$this->gender);
    }

    public function getUser(){
      return $this->hasOne(User::className(),['id'=>'user_id']);
    }

    public function getFullname(){
      return $this->title.$this->name.' '.$this->surname;
    }

    public function getUsername(){
      return $this->user->username;
    }

    public function getEmail(){
      return $this->user->email;
    }
}
