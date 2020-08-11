<?php

use common\models\Student;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentConstructorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '兼职管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-constructor-index">

    <?php
    $myStudent = Student::getStudent(Yii::$app->user->getId());
    var_dump(\yii\helpers\ArrayHelper::map($myStudent , 'id' ,'name'));
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建学生兼职项', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'status_id',
                'value' => 'status.description',
                'filter' => \common\models\WorkStatus::find()
                    ->select(['description', 'id'])
                    ->orderBy('id')
                    ->indexBy('id')
                    ->column(),
            ],
            ['attribute' => 'join_date',
                'format' => ['date', 'php:Y-m-d '],
            ],
            ['attribute' => 'end_date',
                'format' => ['date', 'php:Y-m-d '],
            ],
            [
                'attribute' => 'constructor',
                'value' => 'constructor.name'
            ],
            [
                'attribute' => 'student',
                'value' => 'student.name'
            ],
            'salary',
            //'profile:ntext',
            'agreement',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
