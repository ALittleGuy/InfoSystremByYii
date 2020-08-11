<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * ConstructorSearch represents the model behind the search form of `common\models\Constructor`.
 */
class ConstructorSearch extends Constructor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'join_date', 'status_id'], 'integer'],
            [['name', 'principal_name', 'mobile', 'address', 'license', 'credit_code', 'phone', 'profile','status_id'], 'safe'],
            [['min_salary', 'max_salary'], 'number'],
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
        $query = Constructor::find();
        // add conditions that should always apply here
        return $this->getDataProvider($query , $params);
    }

    public function myConstructorSearch($params){

        $constructor_id = UserConstructor::getConstructorIdByUserId(Yii::$app->user->getId());
        $query = Constructor::find()->where(['in', 'id', $constructor_id]);
        return $this->getDataProvider($query , $params);

    }

    protected function getDataProvider($query , $params){
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
            ],
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
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'join_date' => $this->join_date,
            'status_id' => $this->status_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'principal_name', $this->principal_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'license', $this->license])
            ->andFilterWhere(['like', 'credit_code', $this->credit_code])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'profile', $this->profile]);

        return $dataProvider;
    }

}
