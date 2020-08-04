<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructor */
/* @var $agreement common\models\AgreementModel */
$this->title = '添加兼职项';
$this->params['breadcrumbs'][] = ['label' => '兼职管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-constructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'agreement' => $agreement
    ]) ?>

</div>
