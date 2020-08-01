<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "constructor_status".
 *
 * @property int $id
 * @property string $description
 *
 * @property Constructor[] $constructors
 */
class ConstructorStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'constructor_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description'], 'string', 'max' => 128],
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

    /**
     * Gets query for [[Constructors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstructors()
    {
        return $this->hasMany(Constructor::className(), ['status_id' => 'id']);
    }
}
