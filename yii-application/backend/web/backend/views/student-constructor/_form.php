<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-constructor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'constructor_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'join_date')->textInput() ?>

    <?= $form->field($model, 'qq_url')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
