<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructor */

$this->title = \common\models\Student::findOne(['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => '兼职管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-constructor-view">



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
                'value' => $model->student->name.'('.$model->student_id.')'
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

            [
                'label' => 'agreement',
                'format' => 'raw',
                'value' => Html::img('uploads/agreement/student/' . $model->agreement, ['alt' => 'agreement','width'=> '200' , 'height' => '100'])
            ],
            [
                'label' => 'agreement download',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->agreement != null && $model->isAgreementExist()) {
                        return Html::a($model->agreement, Url::to(['student-constructor/agreement', 'id' => $model->id], true));
                    } else {
                        return '营业执照缺失';
                    }
                }
            ],
            'profile'
        ],
    ]) ?>

</div>
