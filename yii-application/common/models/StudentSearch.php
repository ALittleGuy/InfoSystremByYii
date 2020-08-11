<?php

namespace common\models;

use common\models\Student;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * StudentSearch represents the model behind the search form of `common\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age', 'status_id'], 'integer'],
            [['id', 'name', 'mobile', 'email', 'resume', 'sex', 'major', 'college', 'address', 'profile'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Student::find();

        return $this->getSearch($params, $query);
    }

    public function myStudentSearch($params)
    {
        $constructor_id = UserConstructor::getConstructorIdByUserId(\Yii::$app->user->getId());
        $myStudentConstructors = StudentConstructor::getStudentIdByConstructorId($constructor_id);
        $myStudents = Student::find()->where(['in', 'id', $myStudentConstructors]);
        return $this->getSearch($params, $myStudents);
    }

    protected function getSearch($params, $query)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'age' => $this->age,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'resume', $this->resume])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'major', $this->major])
            ->andFilterWhere(['like', 'college', $this->college])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'profile', $this->profile]);

        return $dataProvider;

    }
}
