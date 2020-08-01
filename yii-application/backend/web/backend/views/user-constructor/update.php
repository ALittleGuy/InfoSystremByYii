<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserConstructor */

$this->title = 'Update User Constructor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-constructor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
