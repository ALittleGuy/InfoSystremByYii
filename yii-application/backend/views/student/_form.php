<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'resume')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sex')->dropDownList(['男'=>'男','女'=> '女'], ['prompt' => '请选择性别']) ?>

            <?= $form->field($model, 'major')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'college')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'age')->textInput() ?>

            <?php $studentStatus = \common\models\StudentStatus::find()->all();
            $statusMap = \yii\helpers\ArrayHelper::map($studentStatus, 'id', 'description');
            ?>

            <?= $form->field($model, 'status_id')->dropDownList($statusMap, ['prompt' => '请选择状态']) ?>

            <?= $form->field($model, 'profile')->textarea() ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
