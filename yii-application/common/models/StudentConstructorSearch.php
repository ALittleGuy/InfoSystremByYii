<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentConstructor;

/**
 * StudentConstructorSearch represents the model behind the search form of `common\models\StudentConstructor`.
 */
class StudentConstructorSearch extends StudentConstructor
{

    public function attributes()
    {
        return array_merge(parent::attributes() ,  ['student' , 'constructor']); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'join_date', 'end_date', 'constructor_id',  'status_id'], 'integer'],
            [['salary'], 'number'],
            [['student_id'] , 'string' , 'max' => 11],
            [['profile', 'agreement' , 'constructor' , 'student'], 'safe'],
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
        $query = StudentConstructor::find();

        // add conditions that should always apply here

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
            'id' => $this->id,
            'join_date' => $this->join_date,
            'end_date' => $this->end_date,
            'salary' => $this->salary,
            'student_constructor.status_id' => $this->status_id,
        ]);

        $query->join('INNER JOIN' , 'student' , 'student.id = student_constructor.student_id');
        $query->join('INNER JOIN' , 'constructor' , 'constructor.id = student_constructor.constructor_id');

        $query->andFilterWhere(['like', 'profile', $this->profile])
            ->andFilterWhere(['like', 'agreement', $this->agreement]);

        $query->andFilterWhere(['like' , 'student.name' , $this->student]);
        $query->andFilterWhere(['like' , 'constructor.name' , $this->constructor]);

        return $dataProvider;
    }
}
