<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publicfile".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $join_date
 */
class Publicfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicfile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['join_date'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'join_date' => 'Join Date',
        ];
    }

    public function isPublicFileExist(){
        $filePath =Yii::getAlias('@uploads') .'/public/'.$this->name;
        if(file_exists($filePath)){
            return true;
        }else{
            return false;
        }
    }


}
