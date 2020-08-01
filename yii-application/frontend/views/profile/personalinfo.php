<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = '个人信息';
$this->params['breadcrumbs']=[
    [
        'label' => '我的',
        'url' => Url::home(true),
    ],
    [
        'label' => $this->title,
        'url' => Url::to(['profile/personalinfo'],true),
    ]

]
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'student_id') ?>

            <?= $form->field($model, 'email') ?>

            <div class="form-group">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>