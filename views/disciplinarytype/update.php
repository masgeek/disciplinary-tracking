<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DISCIPLINARY_TYPE_MODEL */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Disciplinary  Type  Model',
]) . $model->DISCIPLINARY_TYPE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disciplinary  Type  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->DISCIPLINARY_TYPE_ID, 'url' => ['view', 'id' => $model->DISCIPLINARY_TYPE_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="disciplinary--type--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
