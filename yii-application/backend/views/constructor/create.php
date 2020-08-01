<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Constructor */
/* @var $licence common\models\LicenceModel */
/* @var $agreement common\models\AgreementModel */

$this->title = '导入新机构';
$this->params['breadcrumbs'][] = ['label' => 'Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'licence' => $licence , 'agreement' => $agreement
    ]) ?>

</div>
