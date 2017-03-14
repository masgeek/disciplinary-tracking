<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\STUDENT_INCIDENCE */

$this->title = Yii::t('app', 'Create Student  Incidence');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student  Incidences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student--incidence-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
