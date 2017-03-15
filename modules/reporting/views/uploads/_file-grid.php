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
    //'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
    'layout' => "{items}\n{pager}\n{summary}",
    'showFooter' => true,
    'showHeader' => true,
    'showOnEmpty' => true,

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
        //'FILE_PATH', //add file download link
        'FILE_NAME', //add file download link
        'DATE_UPLOADED',
        [
            'header' => 'Download/View',
            'format' => 'raw',
            'value' => function ($data) {
                $file_url = \app\components\HelperComponent::GenerateDownloadLink($data->FILE_PATH);
                $download_link = Html::a(
                    'View/Download <span class="glyphicon glyphicon-download">&nbsp;</span>',
                    $file_url,
                    [
                        'class' => 'btn btn-primary btn-sm',
                        'title' => 'Download '.$data->FILE_NAME
                    ]);

                return $download_link;
            }
        ],
        //['class' => 'yii\grid\ActionColumn'],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Action',
            'headerOptions' => ['width' => '80'],
            'template' => '{delete}',
        ],

    ],
    'rowOptions' => function ($model, $key, $index, $grid) {
        $class = $index % 2 ? 'odd' : 'even';
        return array('key' => $key, 'index' => $index, 'class' => $class);
    },
]); ?>
<?php \yii\widgets\Pjax::end(); ?>

