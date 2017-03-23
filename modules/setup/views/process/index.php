<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\setup\models\Processsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Process  Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process--model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Process  Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'PROCESS_ID',
            //'CASE_TYPE_ID',
            'PROCESS_NAME',
            'DESCRIPTION',
            'ORDER_NO',
            // 'DATE_ADDED',
            // 'DATE_MODIFIED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
