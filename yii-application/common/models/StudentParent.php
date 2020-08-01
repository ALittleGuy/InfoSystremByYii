<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_parent".
 *
 * @property int $id
 * @property int $join_date
 * @property int|null $end_date
 * @property int $parent_id
 * @property int $student_id
 * @property float $salary
 * @property string|null $profile
 *
 * @property ParentCon $parent
 * @property Student $student
 */
class StudentParent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_parent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['join_date', 'parent_id', 'student_id', 'salary'], 'required'],
            [['join_date', 'end_date', 'parent_id', 'student_id'], 'integer'],
            [['salary'], 'number'],
            [['profile'], 'string'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParentCon::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'join_date' => 'Join Date',
            'end_date' => 'End Date',
            'parent_id' => 'Parent ID',
            'student_id' => 'Student ID',
            'salary' => 'Salary',
            'profile' => 'Profile',
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ParentCon::className(), ['id' => 'parent_id']);
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
}
