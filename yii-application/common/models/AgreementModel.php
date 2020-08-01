<?php


namespace common\models;

use yii\web\UploadedFile;
use yii\base\Model;

class AgreementModel extends Model
{
    public $agreementFile;


    public function rules()
    {
        return [
            [['agreementFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg,pdf'],
        ];
    }

    public function upload($fileName){
        if ($this->validate()) {
            $this->agreementFile->saveAs('uploads/agreement/constructor/' . $fileName );
            return true;
        } else {
            return false;
        }
    }


}