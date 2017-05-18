<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 04-May-17
 * Time: 13:44
 *
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $model \app\modules\reporting\models\TRACKING_MODEL
 */

use kartik\detail\DetailView;

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

<!--?php
foreach ($dataProvider->getModels() as $model) {
    /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
    //var_dump($model);
    /* $attributes = [
         'TRACKING_ID',
         'INCIDENCE_ID',
         'PROCESS_ID',
         'COMMENTS',
         'ADDED_BY',
         'ACTED_ON_BY',
         ['attribute' => 'TRACKING_STATUS', 'type' => DetailView::INPUT_DATE],
         ['attribute' => 'DATE_RECEIVED', 'type' => DetailView::INPUT_DATE],
         ['attribute' => 'DATE_UPDATED', 'type' => DetailView::INPUT_DATE],
     ];*/
    $attributes = [
        [
            'group' => true,
            'label' => 'SECTION 1: Identification Information',
            'rowOptions' => ['class' => 'info']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'TRACKING_ID',
                    'label' => 'Book #',
                    'displayOnly' => true,
                    'valueColOptions' => ['style' => 'width:30%']
                ],
                [
                    'attribute' => 'TRACKING_ID',
                    'format' => 'raw',
                    'value' => '<kbd>' . $model->INCIDENCE_ID . '</kbd>',
                    'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true
                ],
            ],
        ],
        /*[
            'columns' => [
                [
                    'attribute' => 'PROCESS_ID',
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
                [
                    'attribute' => 'color',
                    'format' => 'raw',
                    'value' => "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" . $model->color . '</code>',
                    'type' => DetailView::INPUT_COLOR,
                    'valueColOptions' => ['style' => 'width:30%'],
                ],
            ],
        ],*/
        [
            'group' => true,
            'label' => 'SECTION 2: Price / Valuation Amounts',
            'rowOptions' => ['class' => 'info'],
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'attribute' => 'TRACKING_ID',
            'label' => 'Buy Amount ($)',
            'format' => ['decimal', 2],
            'inputContainer' => ['class' => 'col-sm-6'],
        ],
        [
            'attribute' => 'TRACKING_ID',
            'label' => 'Sale Amount ($)',
            'format' => ['decimal', 2],
            'inputContainer' => ['class' => 'col-sm-6'],
        ],
        [
            'label' => 'Difference ($)',
            'value' => $model->TRACKING_ID - $model->PROCESS_ID,
            'format' => ['decimal', 2],
            'inputContainer' => ['class' => 'col-sm-6'],
            // hide this in edit mode by adding `kv-edit-hidden` CSS class
            'rowOptions' => ['class' => 'warning kv-edit-hidden', 'style' => 'border-top: 5px double #dedede'],
        ],
        [
            'group' => true,
            'label' => 'SECTION 3: Book Details',
            'rowOptions' => ['class' => 'info'],
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'DATE_RECEIVED',
                    'value' => \app\components\DATA_FACTORY::StringToDateTime($model->DATE_RECEIVED),
                    'format' => 'date',
                    'type' => DetailView::INPUT_DATE,
                    'widgetOptions' => [
                        'pluginOptions' => ['format' => 'yyyy-mm-dd']
                    ],
                    'valueColOptions' => ['style' => 'width:30%']
                ],
                [
                    'attribute' => 'TRACKING_STATUS',
                    'label' => 'Available?',
                    'format' => 'raw',
                    'value' => $model->TRACKING_STATUS ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>',
                    'type' => DetailView::INPUT_SWITCH,
                    'widgetOptions' => [
                        'pluginOptions' => [
                            'onText' => 'Yes',
                            'offText' => 'No',
                        ]
                    ],
                    'valueColOptions' => ['style' => 'width:30%']
                ],
            ]
        ],
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