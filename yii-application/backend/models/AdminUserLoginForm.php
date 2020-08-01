<?php


namespace backend\models;


use yii\base\Model;
use yii\helpers\Console;
use yii\log\Logger;

class AdminUserLoginForm extends Model
{
    public $student_id;
    public $password;

    private $_user;

    public function rules()
    {
        return [
            [['student_id' , 'password'] , 'required'],
            ['password' , 'validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'student_id' => '学号',
            'password' => '密码'
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误.');
            }
        }
    }

    private function getUser()
    {
        if ($this->_user === null) {
            $this->_user = AdminUser::findByStudentID($this->student_id);
        }
        return $this->_user;
    }

    public function login(){
        if($this->validate()){
            return \Yii::$app->user->login($this->getUser(), 3600 * 24 * 30 );
        }else return false;
    }



}