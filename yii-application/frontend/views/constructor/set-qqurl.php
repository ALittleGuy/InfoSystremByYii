<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = '咨询群设置';
$this->params['breadcrumbs'][] = '机构详细信息';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="constructor-form">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model , 'qqurl')->textInput() ?>

            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

