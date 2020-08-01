<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ConstructorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="constructor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'principal_name') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'min_salary') ?>

    <?php // echo $form->field($model, 'max_salary') ?>

    <?php // echo $form->field($model, 'license') ?>

    <?php // echo $form->field($model, 'credit_code') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'join_date') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'profile') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
