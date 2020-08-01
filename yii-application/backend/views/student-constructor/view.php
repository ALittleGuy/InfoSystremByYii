<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Student Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-constructor-view">

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

    <?php $workStatus = \common\models\WorkStatus::find()->all();
    $statusMap = \yii\helpers\ArrayHelper::map($workStatus, 'id', 'description');
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            [
                'attribute' => 'constructor',
                'value' => $model->constructor->name,
            ],
            [
                'attribute' => 'student ',
                'value' => $model->student->name
            ],
            'salary',
            'profile:ntext',
            'agreement',
            [
                'attribute' => 'status_id',
                'value' => $statusMap[$model->status_id],
            ],
            ['attribute' => 'join_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            ['attribute' => 'end_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
