<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "constructor".
 *
 * @property int $id
 * @property string $name
 * @property string $principal_name
 * @property string $mobile
 * @property string $address
 * @property float $min_salary
 * @property float $max_salary
 * @property string $license
 * @property string $credit_code
 * @property string|null $phone
 * @property int|null $join_date
 * @property int|null $status_id
 * @property string|null $profile
 * @property string|null $agreement
 *
 * @property StudentConstructor[] $studentConstructors
 * @property StudentConstructorInterview[] $studentConstructorInterviews
 */
class Constructor extends \yii\db\ActiveRecord
{


    public function load($data, $formName = null)
    {
        return parent::load($data, $formName); // TODO: Change the autogenerated stub
    }

//    public function behaviors()
//    {
//        return [
//            'upload' => [
//                'class' => 'mdm\upload\UploadBehavior',
//                'attribute' => 'license',
//                'savedAttribute' => 'license' // coresponding with $model->file_id
//            ]];
//
//    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'constructor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'principal_name', 'mobile', 'address', 'min_salary', 'max_salary', 'credit_code'], 'required'],
            [['min_salary', 'max_salary'], 'number'],
            [['join_date', 'status_id'], 'integer'],
            [['name', 'principal_name', 'credit_code' , 'agreement','license'], 'string', 'max' => 128],
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
            'name' => '机构名称',
            'principal_name' => '负责人',
            'mobile' => '联系电话',
            'address' => '机构位置',
            'min_salary' => '最低时薪',
            'max_salary' => '最高时薪',
            'license' => '营业执照',
            'credit_code' => '信用代码',
            'phone' => '座机',
            'join_date' => '加入时间',
            'status_id' => '状态',
            'profile' => '备注',
            'agreement' => '协议书'
        ];
    }

    /**
     * Gets query for [[StudentConstructors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentConstructors()
    {
        return $this->hasMany(StudentConstructor::className(), ['constructor_id' => 'id']);
    }

    /**
     * Gets query for [[StudentConstructorInterviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentConstructorInterviews()
    {
        return $this->hasMany(StudentConstructorInterview::className(), ['constructor_id' => 'id']);
    }

    public function getConstructorstatus()
    {
        return $this->hasOne(ConstructorStatus::className(), ['id' => 'status_id']);
    }

    public function isLicenceExist()
    {
        $filepath = 'uploads/licence/' . $this->license;
        if (file_exists($filepath)) {
            return true;
        } else {
            return false;
        }
    }

    public function isAgreementExist()
    {
        $filepath = 'uploads/agreement/constructor/' . $this->agreement;
        if (file_exists($filepath)) {
            return true;
        } else {
            return false;
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->licenceFile->saveAs('uploads/licence/' . $this->name . '.' . $this->licenceFile->extension);
            return true;
        } else {
            return false;
        }
    }
}
