<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CASE_TYPE_MODEL */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Case  Type  Model',
]) . $model->CASE_TYPE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Case  Type  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CASE_TYPE_ID, 'url' => ['view', 'id' => $model->CASE_TYPE_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="case--type--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
