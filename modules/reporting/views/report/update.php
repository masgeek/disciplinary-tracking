<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\reporting\models\CASE_INCIDENCE_MODEL */
/* @var $uploads \app\modules\tracking\models\FILEUPLOAD */
/* @var $student_case \app\models\STUDENT_INCIDENCE */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Incidence  Model',
]) . $model->INCIDENCE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidence  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->INCIDENCE_ID, 'url' => ['view', 'id' => $model->INCIDENCE_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="incidence--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploads' => $uploads,
        'student_case' => $student_case,
    ]) ?>

</div>
