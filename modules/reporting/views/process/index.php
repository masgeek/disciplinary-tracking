<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Process  Models');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="process--model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Process  Model'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <!--?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'PROCESS_ID',
            'CASE_TYPE_ID',
            'PROCESS_NAME',
            'DESCRIPTION',
            'ORDER_NO',
            // 'DATE_ADDED',
            // 'DATE_MODIFIED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?-->

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model, $key, $index, $grid) {
            /* @var $model \app\modules\reporting\models\PROCESS_MODEL */
            return ['data-sortable-id' => $model->PROCESS_ID];
        },
        'columns' => [
            [
                'class' => \kotchuprik\sortable\grid\Column::className(),
            ],
            'PROCESS_ID',
            'PROCESS_NAME',
            'ORDER_NO',
        ],
        'options' => [
            'data' => [
                'sortable-widget' => 1,
                'sortable-url' => \yii\helpers\Url::toRoute(['sorting']),
            ]
        ],
    ]); ?>

</div>
