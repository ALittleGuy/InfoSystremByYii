<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "handle_status".
 *
 * @property int $id
 * @property string $description
 */
class HandleStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'handle_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'description'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string', 'max' => 128],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
        ];
    }
}
