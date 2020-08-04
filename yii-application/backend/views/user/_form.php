<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <div class="row">
        <div class="col-lg-5">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>


    <?php $userStatus = \common\models\UserStatus::find()->all();
    $statusMap = \yii\helpers\ArrayHelper::map($userStatus, 'id', 'description');
    ?>

    <?= $form->field($model, 'status')->dropDownList($statusMap , ['prompt' => '请选择状态']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
