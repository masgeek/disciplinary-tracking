<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'FILE_UPLOAD_ID',
        'INCIDENCE_ID',
        'FILE_PATH',
        'DATE_UPLOADED',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>

