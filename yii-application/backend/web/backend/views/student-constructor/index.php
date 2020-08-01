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

            'id',
            'constructor_id',
            'user_id',
            'join_date',
            'end_date',
            //'qq_url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
