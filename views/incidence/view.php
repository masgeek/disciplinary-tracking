<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\INCIDENCE_MODEL */

$this->title = $model->INCIDENCE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidence  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="incidence--model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->INCIDENCE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Add to Incidence'), ['//add-case', 'incidence_id' => $model->INCIDENCE_ID], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Delete Incidence'), ['delete', 'id' => $model->INCIDENCE_ID], [
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
            //'INCIDENCE_ID',
            'STUDENT_REG_NO',
            'DATE_REPORTED',
            'CASE_DESCRIPTION:ntext',
            //'STATUS_CODE',
            'sTATUSCODE.STATUS_NAME',
            'REPORTED_BY',
        ],
    ]) ?>

</div>
