<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Incidence Tracking Summary');
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    //'TRACKING_ID',
    //'INCIDENCE_ID',
    'pROCESS.PROCESS_NAME',
    'pROCESS.CASE_TYPE_ID',
    [
        'header' => 'PROCESS_ID',
        'format' => 'raw',
        'value' => function ($data) {
            //var_dump($data->tRACKINGDATESs);
            return 1;
        }
    ],
    'PROCESS_ID',
    'COMMENTS',
    'TRACKING_STATUS',
    'ADDED_BY',
    'ACTED_ON_BY',
    'DATE_RECEIVED',
    //'DATE_UPDATED',

    ['class' => 'yii\grid\ActionColumn'],
];
?>
<div class="incidence--model-index">
    <!--p>
        <?= Html::a(Yii::t('app', 'Create Incidence  Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p-->
    <?php Pjax::begin(); ?>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'layout' => "{items}\n{pager}\n{summary}",
        'showFooter' => true,
        'showHeader' => true,
        'showOnEmpty' => true,
        'export' => false,
        'responsive' => true,
        'hover' => true,
        'columns' => $gridColumns,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-upload"></i> ' . ucwords(strtolower($this->title)) . '</h3>',
            'type' => 'primary',
            'footer' => false
        ],
    ]); ?>

    <?php Pjax::end(); ?></div>