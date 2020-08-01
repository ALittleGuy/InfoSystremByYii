<?php


namespace backend\models;


use yii\base\Model;

class PasswordResetForm extends Model
{
    public $password;
    public $password_confirm;

    public function rules()
    {
        return [
            [['password' , 'password_confirm'] , 'required'],
            [['password','password_confirm'], 'string', 'min' => 6],
            ['password_confirm', 'compare', 'compareAttribute' => 'password','message'=>'两次输入的密码不一致！']
        ];
    }

    public function isEqual($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->password===$this->password_confirm) {
                $this->addError($attribute, '两次输入的密码不同');
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'password_confirm' => '确认密码',
            'password' => '密码'
        ];
    }


}