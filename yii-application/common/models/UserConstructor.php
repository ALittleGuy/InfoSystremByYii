<?php

namespace common\models;

use MongoDB\Driver\Query;
use Yii;

/**
 * This is the model class for table "user_constructor".
 *
 * @property int $id
 * @property int $constructor_id
 * @property int $user_id
 * @property int $join_date
 * @property string $qq_url
 * @property int $end_date
 * @property Constructor $constructor
 * @property int status_id
 * @property User $user
 *
 */
class UserConstructor extends \yii\db\ActiveRecord
{

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->join_date = time();
            }
            return true;

        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_constructor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['constructor_id', 'user_id',  'qq_url'], 'required'],
            [['constructor_id', 'user_id', 'join_date' , 'end_date' , 'status_id'], 'integer'],
            [['qq_url'], 'string', 'max' => 128],
            [['constructor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Constructor::className(), 'targetAttribute' => ['constructor_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'constructor_id' => '机构名称',
            'user_id' => '负责人',
            'join_date' => '开始时间',
            'end_date' => '结束时间',
            'qq_url' => '咨询群号',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getHandleStauts(){
        return $this->hasOne(HandleStatus::className() , ['id' => 'user_constructor.status_id']);
    }

    public static function getConstructorIdByUserId($userId){
        $query = new \yii\db\Query();
        $constructor_id = $query->select('constructor_id')->from('user_constructor')
            ->where(['user_id' => $userId])->column();
        return $constructor_id;
    }

}
