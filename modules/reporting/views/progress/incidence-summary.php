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
            /* @var $data \app\modules\reporting\models\TRACKING_MODEL */
            return $data->iNCIDENCE->CASE_DESCRIPTION;
        }
    ],
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
        'visible' => false,
        'format' => 'date',
        'value' => function ($model) {
            /* @var $model \app\modules\reporting\models\TRACKING_MODEL */
            $date_time = \app\components\DATA_FACTORY::StringToDateTime($model->DATE_UPDATED);
            return $date_time;
        },
    ]

    //['class' => 'yii\grid\ActionColumn'],
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
        'showFooter' => false,
        'showHeader' => true,
        'showOnEmpty' => true,
        'export' => false,
        'responsive' => true,
        'hover' => true,
        'columns' => $gridColumns,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-bell"></i> ' . ucwords(strtolower($this->title)) . '</h3>',
            'type' => 'primary',
            'footer' => false
        ],
    ]); ?>

    <?php Pjax::end(); ?></div>