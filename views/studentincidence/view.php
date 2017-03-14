<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\STUDENT_INCIDENCE */

$this->title = $model->cASETYPE->CASE_TYPE_NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Student  Incidences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$uploadedFiles = $model->iNCIDENCE->fILEUPLOADs;
?>
<div class="student--incidence-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->STUDENT_INCIDENCE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->STUDENT_INCIDENCE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'STUDENT_INCIDENCE_ID',
            'iNCIDENCE.STUDENT_REG_NO',
            'iNCIDENCE.sTATUSCODE.STATUS_NAME',
            'iNCIDENCE.CASE_DESCRIPTION',
            //'CASE_TYPE_ID',
            'cASETYPE.CASE_TYPE_NAME',
            //'INCIDENCE_ID',
        ],
    ]) ?>

</div>
