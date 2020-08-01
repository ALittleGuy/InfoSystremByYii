<?php

namespace common\models;

use Yii;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['join_date', 'constructor_id', 'student_id', 'salary'], 'required'],
            [['join_date', 'end_date', 'constructor_id', 'status_id'], 'integer'],
            [['salary'], 'number' , 'message' => 'required a number'],
            [['profile'], 'string' , 'message' => 'required a string'],
            [['agreement'], 'string', 'max' => 128 ],
            [['constructor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Constructor::className(), 'targetAttribute' => ['constructor_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => WorkStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'join_date' => 'Join Date',
            'end_date' => 'End Date',
            'constructor_id' => 'Constructor ID',
            'student_id' => 'Student ID',
            'salary' => 'Salary',
            'profile' => 'Profile',
            'agreement' => 'Agreement',
            'status_id' => 'Status ID',
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
}
