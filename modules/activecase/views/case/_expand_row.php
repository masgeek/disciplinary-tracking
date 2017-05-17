<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 04-May-17
 * Time: 13:44
 *
 * @var $dataProvider \yii\data\ActiveDataProvider
 */


$GridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'PROCESS_ID',
    'INCIDENCE_ID',
    'ADDED_BY',
    'ACTED_ON_BY',
    'COMMENTS',
    'TRACKING_STATUS',
    [
        'attribute' => 'DATE_RECEIVED',
        'format' => 'date',
        'value' => function ($data) {
            /* @var $data \app\modules\reporting\models\TRACKING_MODEL */
            $date_time = \app\components\DATA_FACTORY::StringToDateTime($data->DATE_RECEIVED);
            return $date_time;
        },
    ],
    [
        'attribute' => 'DATE_UPDATED',
        'format' => 'date',
        'value' => function ($data) {
            /* @var $data \app\modules\reporting\models\TRACKING_MODEL */
            $date_time = \app\components\DATA_FACTORY::StringToDateTime($data->DATE_UPDATED);
            return $date_time;
        },
    ]
];
?>

<?= \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'export' => false,
    'columns' => $GridColumns,
    'showOnEmpty' => false,
    //'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'responsive' => true,
    'bordered' => true,
    'striped' => false,
    'condensed' => true,
    'hover' => false,
    'showPageSummary' => false,
    'persistResize' => false,
]); ?>