<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserConstructor */

$this->title = 'Create User Constructor';
$this->params['breadcrumbs'][] = ['label' => 'User Constructors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-constructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
