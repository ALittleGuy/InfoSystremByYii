<?php


namespace common\models;

use yii\web\UploadedFile;
use yii\base\Model;

class LicenceModel extends Model
{
    public $licenceFile;


    public function rules()
    {
        return [
            [['licenceFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg'],
        ];
    }

    public function upload($fileName){
        if ($this->validate()) {
            $this->licenceFile->saveAs(\Yii::getAlias('@uploads').'/licence/' . $fileName );
            return true;
        } else {
            return false;
        }
    }


}