<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Publicfile */
/* @var $publicfile common\models\PublicFileModel */
$this->title = 'Create Publicfile';
$this->params['breadcrumbs'][] = ['label' => 'Publicfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicfile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'publicfile' => $publicfile
    ]) ?>

</div>
