<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    //'INCIDENCE_ID',
    'STUDENT_REG_NO',
    'sTATUSCODE.STATUS_DESCRIPTION',
    'fACULTY.FACULTY_NAME',
    'REPORTED_BY',
    //'FACULTY_CODE',
    [
        'attribute' => 'DATE_REPORTED',
        'filter' => null,
    ],
    //'DATE_ADDED',

    ['class' => 'yii\grid\ActionColumn'],
];

?>
<div class="disciplinary--type--model-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]); ?>
</div>
