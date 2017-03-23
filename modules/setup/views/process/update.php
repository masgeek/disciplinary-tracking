<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\PROCESS_MODEL */

$this->title = 'Update Process  Model: ' . $model->PROCESS_ID;
$this->params['breadcrumbs'][] = ['label' => 'Process  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROCESS_ID, 'url' => ['view', 'id' => $model->PROCESS_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="process--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
