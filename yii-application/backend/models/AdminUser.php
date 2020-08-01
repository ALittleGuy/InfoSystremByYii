<?php

namespace backend\models;

use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\base\Exception;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "adminuser".
 *
 * @property int $id
 * @property string $username
 * @property string $student_id
 * @property string $password
 * @property string $email
 * @property string|null $profile
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 */
class AdminUser extends \yii\db\ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adminuser';
    }

    public static function findByStudentID($student_id)
    {
        return static::findOne(['student_id'=>$student_id]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'username', 'student_id', 'password', 'email', 'auth_key', 'password_hash'], 'required'],
            [['id'], 'integer'],
            [['profile'], 'string'],
            [['username', 'password', 'email'], 'string', 'max' => 128],
            [['auth_key'], 'string', 'max' => 32],
            [['student_id'],'string' , 'max' => 11],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'student_id' => 'StudentID',
            'password' => 'Password',
            'email' => 'Email',
            'profile' => 'Profile',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    //生成秘钥
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                try {
                    $this->auth_key = \Yii::$app->security->generateRandomString();
                } catch (Exception $e) {
//                    echo $e;
                }
            }
            return true;
        }
        return false;
    }


    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
        // TODO: Implement findIdentity() method.
    }


    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password , $this->password_hash);
    }

    public function setPassword($password){
        try {
            $this->password_hash = Yii::$app->security->generatePasswordHash($password);
        } catch (Exception $e) {
        }
    }

    public function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }


}
