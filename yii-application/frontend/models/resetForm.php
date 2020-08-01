<?php


namespace frontend\models;


use yii\base\Model;

class resetForm extends Model
{
    public $student_id;
    public $username;
    public $email;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['student_id' , 'required'],
            ['student_id' , 'string' , 'min'=>11 , 'max'=>11],
        ];
    }
}