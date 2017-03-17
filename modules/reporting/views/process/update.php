<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\reporting\models\PROCESS_MODEL */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Process  Model',
]) . $model->PROCESS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Process  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->PROCESS_ID, 'url' => ['view', 'id' => $model->PROCESS_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="process--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
