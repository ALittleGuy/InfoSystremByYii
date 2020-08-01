<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StudentConstructor */

$this->title = 'Create Student Constructor';
$this->params['breadcrumbs'][] = ['label' => 'Student Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-constructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
