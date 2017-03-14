<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\reporting\models\INCIDENCE_MODEL */
/* @var $uploads \app\modules\tracking\models\FILEUPLOAD */
/* @var $student_case \app\models\STUDENT_INCIDENCE */


$this->title = Yii::t('app', 'Create Incidence  Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidence  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidence--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploads' => $uploads,
        'student_case' => $student_case,
    ]) ?>

</div>
