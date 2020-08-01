<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserConstructor */

$this->title = '更新更进项信息: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-constructor-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('完成跟进', ['finish' , 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
