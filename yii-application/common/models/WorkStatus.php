<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_status".
 *
 * @property int $id
 * @property string $description
 *
 * @property StudentConstructor[] $studentConstructors
 */
class WorkStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'description'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string', 'max' => 128],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[StudentConstructors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentConstructors()
    {
        return $this->hasMany(StudentConstructor::className(), ['status_id' => 'id']);
    }
}
