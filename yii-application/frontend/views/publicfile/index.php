<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PublicfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Publicfiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicfile-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            [
                'attribute' => 'join_date',
                'format' => ['date' , 'php:Y-m-d']
            ],

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
