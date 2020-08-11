<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ConstructorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机构管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constructor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'principal_name',
            'mobile',
            'address',
            'min_salary',
            'max_salary',
//            'license',
            'credit_code',
//            'phone',
            //'join_date',
            ['attribute' => 'status_id',
                'value' => 'constructorstatus.description',
                'filter' => \common\models\ConstructorStatus::find()
                    ->select(['description', 'id'])
                    ->orderBy('id')
                    ->indexBy('id')
                    ->column(),
            ],
            //'profile',

            [
                'attribute' => 'check',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('check' , ['view' , 'id' => $model->id] ,['class' => 'btn btn-success']);
                }
            ],


        ],
    ]); ?>

</div>
