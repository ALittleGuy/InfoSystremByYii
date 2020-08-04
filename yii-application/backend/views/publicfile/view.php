<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Publicfile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Publicfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="publicfile-view">

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
            'id',
            'name',
            'description:ntext',
            'join_date',
            [
                'label' => '下载',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->name != null && $model->isPublicFileExist()) {
                        return Html::a($model->name, Url::to(['publicfile/publicfile', 'id' => $model->id], true));
                    } else {
                        return '协议书缺失';
                    }
                }
            ],
        ],
    ]) ?>

</div>
