<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Incidence  Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidence--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Incidence  Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'INCIDENCE_ID',
            'STUDENT_REG_NO',
            'DATE_REPORTED',
            'CASE_DESCRIPTION:ntext',
            'STATUS_CODE',
            // 'REPORTED_BY',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
