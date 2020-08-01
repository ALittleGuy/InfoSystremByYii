<?php

namespace common\models;

use phpDocumentor\Reflection\Types\String_;
use phpDocumentor\Reflection\Types\This;
use Yii;

/**
 * This is the model class for table "student".
 *
 * @property string $id
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string|null $resume
 * @property string|null $sex
 * @property string|null $major
 * @property string|null $college
 * @property string|null $address
 * @property int|null $age
 * @property int|null $status_id
 * @property string $profile
 *
 * @property StudentConstructor[] $studentConstructors
 * @property StudentConstructorInterview[] $studentConstructorInterviews
 * @property StudentParent[] $studentParents
 */
class student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'mobile', 'email'], 'required'],
            [['age', 'status_id'], 'integer'],
            [['id', 'mobile'], 'string', 'max' => 11],
            [['name', 'email', 'resume', 'major', 'college', 'address'], 'string', 'max' => 128],
            [['profile'] , 'string'],
            [['sex'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'mobile' => '电话',
            'email' => '邮箱',
            'resume' => '简历',
            'sex' => '性别',
            'major' => '专业',
            'college' => '学院',
            'address' => '地址',
            'age' => '年龄',
            'status_id' => '状态',
            'profile' => '备注'
        ];
    }

    /**
     * Gets query for [[StudentConstructors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentConstructors()
    {
        return $this->hasMany(StudentConstructor::className(), ['student_id' => 'id']);
    }

//    /**
//     * Gets query for [[StudentConstructorInterviews]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getStudentConstructorInterviews()
//    {
//        return $this->hasMany(StudentConstructorInterview::className(), ['student_id' => 'id']);
//    }
//
//    /**
//     * Gets query for [[StudentParents]].
//     *
//     * @return \yii\db\ActiveQuery
//     */
//    public function getStudentParents()
//    {
//        return $this->hasMany(StudentParent::className(), ['student_id' => 'id']);
//    }

    public function getStudentstatus()
    {
        return $this->hasOne(StudentStatus::className()  , ['id' => 'status_id']);
    }
}
