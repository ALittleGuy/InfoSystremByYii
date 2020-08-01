<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserConstructorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机构跟进表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-constructor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新建跟进项', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



            ['attribute'=>'name',
                'value'=>'constructor.name',
            ],
            ['attribute'=>'username',
                'value'=>'user.username',
            ],
            ['attribute' => 'join_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            ['attribute' => 'end_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            'qq_url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
