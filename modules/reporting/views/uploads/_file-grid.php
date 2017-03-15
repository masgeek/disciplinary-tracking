<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $case_type_id */

$case_name = \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseName($case_type_id);
?>
<h2><?= ucfirst(strtolower($case_name)) ?> Uploads</h2>
<?php \yii\widgets\Pjax::begin([
    'id' => 'uploads_grid',
]); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'pjax' => true, // pjax is set to always true for this demo
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'FILE_UPLOAD_ID',
        //'INCIDENCE_ID',
        /*[
            'header' => 'INCIDENCE_ID',
            'value' => function ($row) use ($case_type_id) {
                return \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseName($case_type_id);
            }
        ],*/
        'FILE_PATH', //add file download link
        'DATE_UPLOADED',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<?php \yii\widgets\Pjax::end(); ?>

