<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "student_constructor".
 * @property int $id
 * @property int $join_date
 * @property int|null $end_date
 * @property int $constructor_id
 * @property string $student_id
 * @property float $salary
 * @property string|null $profile
 * @property string|null $agreement
 * @property int $status_id
 *
 * @property Constructor $constructor
 * @property Student $student
 * @property WorkStatus $status
 */
class StudentConstructor extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_constructor';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'join_date' => '开始日期',
            'end_date' => '结束日期',
            'constructor_id' => '机构',
            'student_id' => '学生',
            'profile' => '备注',
            'salary' => '工资（元/时）',
            'agreement' =>'协议书',
            'status_id' => '状态',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['join_date', 'constructor_id', 'student_id', 'salary'], 'required'],
            [['constructor_id', 'status_id'], 'integer'],
            [['salary'], 'number', 'message' => 'required a number'],
            [['profile'], 'string', 'message' => 'required a string'],
            [['agreement'], 'string', 'max' => 128],
            [['constructor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Constructor::className(), 'targetAttribute' => ['constructor_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['end_date']  , 'safe']
        ];
    }



    /**
     * Gets query for [[Constructor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstructor()
    {
        return $this->hasOne(Constructor::className(), ['id' => 'constructor_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(WorkStatus::className(), ['id' => 'status_id']);
    }

    public function isAgreementExist()
    {
        $filepath = Yii::getAlias('@uploads').'/agreement/student/' . $this->agreement;
        if (file_exists($filepath)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getStudentIdByConstructorId($constructor_id){
        $query = new Query();
        $myStudentConstructors = $query->select('student_id')->from('student_constructor')
            ->where(['in', 'constructor_id', $constructor_id])->column();
        return $myStudentConstructors;
    }
}
