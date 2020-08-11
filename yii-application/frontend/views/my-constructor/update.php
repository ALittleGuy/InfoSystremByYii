<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Constructor */
/* @var $licence common\models\LicenceModel */
/* @var $agreement common\models\AgreementModel*/

$this->title = '更新机构: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '机构管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '机构信息更新';
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="constructor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'licence' => $licence , 'agreement' => $agreement
    ]) ?>

</div>
