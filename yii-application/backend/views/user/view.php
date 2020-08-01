<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新用户', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除用户', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php $userStatus = \common\models\UserStatus::find()->all();
    $statusMap = \yii\helpers\ArrayHelper::map($userStatus, 'id', 'description');
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'student_id',
            'email:email',
            [
                'label' => '状态',
                'value' => $statusMap[$model->status],
            ],
            ['attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            ['attribute' => 'updated_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            'verification_token',
            'password_hash',
            'password_reset_token',
            'auth_key',
        ],
    ]) ?>

</div>
