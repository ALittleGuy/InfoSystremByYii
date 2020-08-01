<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserConstructor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-constructor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=>'user_id',
                'value'=>$model->constructor->name,
            ],
            ['attribute'=>'constructor_id',
                'value'=>$model->user->username,
            ],
            ['attribute' => 'join_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            ['attribute' => 'end_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            'qq_url:url',
        ],
    ]) ?>

</div>
