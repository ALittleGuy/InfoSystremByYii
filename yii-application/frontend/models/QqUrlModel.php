<?php


namespace frontend\models;


use yii\base\Model;

class QqUrlModel extends Model
{
    public $qqurl;

    public function rules()
    {
        return [
            [['qqurl'] , 'required']
        ];
    }
}