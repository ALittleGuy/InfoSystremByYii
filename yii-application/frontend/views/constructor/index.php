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

    <p>
        <?= Html::a('导入新机构', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            //'min_salary',
            //'max_salary',
            //'license',
            //'credit_code',
            //'phone',
            //'join_date',
            //'status_id',
            //'profile',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
