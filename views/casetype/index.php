<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Case  Type  Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case--type--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Case  Type  Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CASE_TYPE_ID',
            'DISCIPLINARY_TYPE_ID',
            'CASE_TYPE_NAME',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
