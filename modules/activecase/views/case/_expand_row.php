<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 04-May-17
 * Time: 13:44
 *
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

use kartik\detail\DetailView;

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

<!--?= \kartik\grid\GridView::widget([
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
]); ?-->

<?php
foreach ($dataProvider->getModels() as $model) {
    /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
    //var_dump($model);
    $attributes = [
        'TRACKING_ID',
        'INCIDENCE_ID',
        'PROCESS_ID',
        'COMMENTS',
        'ADDED_BY',
        'ACTED_ON_BY',
        ['attribute' => 'TRACKING_STATUS', 'type' => DetailView::INPUT_DATE],
        ['attribute' => 'DATE_RECEIVED', 'type' => DetailView::INPUT_DATE],
        ['attribute' => 'DATE_UPDATED', 'type' => DetailView::INPUT_DATE],
    ];

    echo DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
        'mode' => DetailView::MODE_VIEW,
        'panel' => [
            'heading' => 'Book # ' . $model->TRACKING_ID,
            'type' => DetailView::TYPE_INFO,
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'hAlign' => DetailView::ALIGN_RIGHT,
        'vAlign' => DetailView::ALIGN_MIDDLE,
        'fadeDelay' => '1000',
        'container' => ['id' => 'tracking-status'],
    ]);

}
?>
<!--?= DetailView::widget([
    'model' => $dataProvider,
    'condensed' => true,
    'hover' => true,
    'mode' => DetailView::MODE_VIEW,
    'panel' => [
        'heading' => 'Book # ',// . $model->id,
        'type' => DetailView::TYPE_INFO,
    ],
    'attributes' => [
        'code',
        'name',
        ['attribute' => 'publish_date', 'type' => DetailView::INPUT_DATE],
    ]
])
?-->