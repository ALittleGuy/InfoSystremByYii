<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentConstructorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Constructors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-constructor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Student Constructor', ['create'], ['class' => 'btn btn-success']) ?>
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
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            ['attribute' => 'end_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
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
