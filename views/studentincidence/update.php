<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\STUDENT_INCIDENCE */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Student  Incidence',
]) . $model->STUDENT_INCIDENCE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student  Incidences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->STUDENT_INCIDENCE_ID, 'url' => ['view', 'id' => $model->STUDENT_INCIDENCE_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="student--incidence-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
