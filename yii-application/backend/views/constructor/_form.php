<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Constructor */
/* @var $form yii\widgets\ActiveForm */
/* @var $licence common\models\LicenceModel */
/* @var $agreement common\models\AgreementModel */
?>

<div class="constructor-form">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'principal_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'min_salary')->textInput() ?>

            <?= $form->field($model, 'max_salary')->textInput() ?>

            <?= Html::img('uploads/agreement/constructor/'.$model->agreement, ['alt' => '协议书' , 'width' => '200' , 'height' => '100']) ?>

            <?= $form->field($agreement, 'agreementFile')->fileInput() ?>

            <?= Html::img('uploads/licence/'.$model->license, ['alt' => '营业执照','width' => '200' , 'height' => '100']) ?>


            <?= $form->field($licence, 'licenceFile')->fileInput() ?>

            <?= $form->field($model, 'credit_code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'join_date')->widget(DatePicker::className()
                ,  ['options' => ['class' => 'from-control' ],
                    'dateFormat' => 'yyyy-MM-dd'])  ?>

            <?php $constructorStatus = \common\models\ConstructorStatus::find()->all();
            $statusMap = \yii\helpers\ArrayHelper::map($constructorStatus, 'id', 'description');
            ?>

            <?= $form->field($model, 'status_id')->dropDownList($statusMap, ['prompt' => '请选择状态']) ?>

            <?= $form->field($model, 'profile')->textInput(['maxlength' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
