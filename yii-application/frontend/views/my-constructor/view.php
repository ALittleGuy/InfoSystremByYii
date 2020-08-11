<?php

use common\models\ConstructorStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Constructor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '机构管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="constructor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php $constructorStatus = ConstructorStatus::find()->all();
    $statusMap = ArrayHelper::map($constructorStatus, 'id', 'description');
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'principal_name',
            'mobile',
            'address',
            'min_salary',
            'max_salary',

            [
                'label' => '协议书',
                'format' => 'raw',
                'value' => Html::img('uploads/agreement/constructor/' . $model->license, ['alt' => '协议书缺失' , 'width'=> '200' , 'height' => '100'])
            ],
            [
                'label' => '协议书下载',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->agreement != null && $model->isAgreementExist()) {
                        return Html::a($model->agreement, Url::to(['constructor/agreement', 'id' => $model->id], true));
                    } else {
                        return '协议书缺失';
                    }
                }
            ],

            [
                'label' => '营业执照',
                'format' => 'raw',
                'value' => Html::img('uploads/licence/' . $model->license, ['alt' => '营业执照','width'=> '200' , 'height' => '100'])
            ],
            [
                'label' => '营业执照下载',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->license != null && $model->isLicenceExist()) {

                        return Html::a($model->license, Url::to(['constructor/licence', 'id' => $model->id], true));
                    } else {
                        return '营业执照缺失';
                    }
                }
            ],
            'credit_code',
            'phone',
            ['attribute' => 'join_date',
                'format' => ['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'label' => '状态',
                'value' => $model->status_id >=0 && $model->status_id<=4 ? '未设置': $statusMap[$model->status_id]
            ],
            'profile',
        ],
    ]) ?>

</div>
