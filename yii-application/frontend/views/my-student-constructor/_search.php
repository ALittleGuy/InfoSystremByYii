<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-constructor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'join_date') ?>

    <?= $form->field($model, 'end_date') ?>

    <?= $form->field($model, 'constructor_id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?php // echo $form->field($model, 'salary') ?>

    <?php // echo $form->field($model, 'profile') ?>

    <?php // echo $form->field($model, 'agreement') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
