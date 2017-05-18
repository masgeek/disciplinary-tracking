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
    [
        'header' => 'Process Name',
        'attribute' => 'INCIDENCE_ID',
        //'width' => '100%',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            $data = $model->pROCESS;
            return $data->PROCESS_NAME;
        },
        //'group' => true,  // enable grouping,
        //'groupedRow' => true,                    // move grouped column to a single grouped row
        //'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
        //'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
    ],
    //'PROCESS_ID',
    'COMMENTS',
    [
        'header' => 'Status',
        'attribute' => 'TRACKING_STATUS',
        'value' => function ($model) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            return $model->TRACKING_STATUS ? '<span class="label label-success">Complete</span>' : '<span class="label label-danger">Incomplete</span>';
        },
        'format' => 'raw',
    ],
    [
        'attribute' => 'ADDED_BY',
        'value' => function ($model) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            return $model->aDDED_BY ? $model->aDDED_BY->PF_NO : null;
        },
        'format' => 'raw',
    ],
    [
        'attribute' => 'ACTED_ON_BY',
        'value' => function ($model) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            return $model->aCTED_ON_BY ? $model->aCTED_ON_BY->PF_NO : null;
        },
        'format' => 'raw',
    ],
    [
        'attribute' => 'DATE_RECEIVED',
        'format' => 'date',
        'value' => function ($model) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            $date_time = \app\components\DATA_FACTORY::StringToDateTime($model->DATE_RECEIVED);
            return $date_time;
        },
    ],
    [
        'attribute' => 'DATE_UPDATED',
        'format' => 'date',
        'value' => function ($model) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            $date_time = \app\components\DATA_FACTORY::StringToDateTime($model->DATE_UPDATED);
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
    'emptyText' => 'Not tracking information yet',
    'summary' => false,
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'responsive' => true,
    //'bordered' => true,
    //'striped' => true,
    //'condensed' => true,
    //'hover' => true,
    'showPageSummary' => false,
    'persistResize' => false,
]); ?>