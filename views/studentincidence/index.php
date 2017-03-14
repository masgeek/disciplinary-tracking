<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Student  Incidences');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student--incidence-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Student  Incidence'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'STUDENT_INCIDENCE_ID',
            'CASE_TYPE_ID',
            'INCIDENCE_ID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
