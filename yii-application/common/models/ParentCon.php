<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "parent_con".
 *
 * @property int $id
 * @property string $name
 * @property string $principal_name
 * @property string $mobile
 * @property string $address
 * @property float $min_salary
 * @property float $max_salary
 * @property string $license_top
 * @property string $license_back
 * @property string $credit_code
 * @property string|null $phone
 * @property int|null $join_date
 * @property int|null $status_id
 * @property string|null $profile
 *
 * @property StudentParent[] $studentParents
 */
class ParentCon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parent_con';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'principal_name', 'mobile', 'address', 'min_salary', 'max_salary', 'license_top', 'license_back', 'credit_code'], 'required'],
            [['min_salary', 'max_salary'], 'number'],
            [['join_date', 'status_id'], 'integer'],
            [['name', 'principal_name', 'license_top', 'license_back', 'credit_code'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 11],
            [['address', 'profile'], 'string', 'max' => 256],
            [['phone'], 'string', 'max' => 13],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'principal_name' => 'Principal Name',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'min_salary' => 'Min Salary',
            'max_salary' => 'Max Salary',
            'license_top' => 'License Top',
            'license_back' => 'License Back',
            'credit_code' => 'Credit Code',
            'phone' => 'Phone',
            'join_date' => 'Join Date',
            'status_id' => 'Status ID',
            'profile' => 'Profile',
        ];
    }

    /**
     * Gets query for [[StudentParents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentParents()
    {
        return $this->hasMany(StudentParent::className(), ['parent_id' => 'id']);
    }
}
