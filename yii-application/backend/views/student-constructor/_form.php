<?php

use common\models\Constructor;
use common\models\WorkStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-constructor-form">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'constructor_id')->dropDownList(
                    ArrayHelper::map(Constructor::find()
                        ->where(['status_id' => '1'])->
                        all(), 'id', 'name'),['prompt' => '请选择相应的机构']
            ) ?>

            <?= $form->field($model, 'student_id')->textInput() ?>

            <?= $form->field($model, 'salary')->textInput() ?>

            <?= $form->field($model, 'profile')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'agreement')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status_id')->dropDownList(
                    ArrayHelper::map(WorkStatus::find()->all() , 'id' , 'description')
            ) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>