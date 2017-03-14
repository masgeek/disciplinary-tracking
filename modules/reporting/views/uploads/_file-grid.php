<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php \yii\widgets\Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'id' => 'uploads_grid',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'FILE_UPLOAD_ID',
        'INCIDENCE_ID',
        'FILE_PATH', //add file download link
        'DATE_UPLOADED',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php \yii\widgets\Pjax::end(); ?>

