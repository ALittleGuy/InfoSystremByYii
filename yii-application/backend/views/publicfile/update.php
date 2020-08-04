<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Publicfile */
/* @var $publicfile common\models\PublicFileModel */
$this->title = 'Update Publicfile: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Publicfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="publicfile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'publicfile' => $publicfile
    ]) ?>

</div>
