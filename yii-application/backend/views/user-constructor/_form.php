<?php

use common\models\User;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserConstructor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-constructor-form">
    <div class="row">
        <div class="col-lg-5">
            <?php
            $user = User::find()->where
            ?>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'constructor_id')
                ->dropDownList(
                    \common\models\Constructor::find()
                        ->select(['name', 'id'])
                        ->where(['status_id' => '2'])
                        ->indexBy('id')
                        ->orderBy('name')
                        ->column(), ['prompt' => '请选择机构']
                ) ?>




            <?= $form->field($model, 'user_id')
                ->dropDownList(User::find()
                    ->select(['username', 'id'])
                    ->where(['status' => '1'])
                    ->indexBy('id')
                    ->orderBy('username')
                    ->column(), ['prompt' => '请选择成员']) ?>

            <?= $form->field($model, 'qq_url')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
