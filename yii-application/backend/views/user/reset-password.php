<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '重置密码: ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->username, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = ['label' => 'Update' , 'url' => ['update' , 'id' => $user->id]];
$this->params['breadcrumbs'][] = '重置密码';

;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请输入两次相同的密码</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password_confirm')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('重置', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>