<?php


namespace common\models;

use yii\web\UploadedFile;
use yii\base\Model;

class PublicFileModel extends Model
{
    public $publicfile;


    public function rules()
    {
        return [
            [['publicfile'], 'file', 'skipOnEmpty' => true ],
            [['publicfile'] , 'required']
        ];
    }

    public function upload($fileName){
        if ($this->validate()) {
            $this->publicfile->saveAs('uploads/public/' . $fileName );
            return true;
        } else {
            return false;
        }
    }


}