<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $case_type_id */

$case_name = \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseName($case_type_id);
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],
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
                    'title' => 'Download ' . $data->FILE_NAME,
                    'target' => '_blank',
                    'data-pjax' => '0'
                ]);
            return $download_link;
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => true,
        'dropdownOptions' => ['class' => 'pull-right'],
        'template' => '{delete}',
        'urlCreator' => function ($action, $model, $key, $index) {
            $url = '#';
            if ($action == 'delete') {
                $url = \yii\helpers\Url::toRoute(['uploads/delete', 'id' => $model->FILE_UPLOAD_ID]);
            }
            return $url;
        },
        'deleteOptions' => [
            'title' => 'This will launch the uploaded file item!',
            'data-toggle' => 'tooltip',
            //'label' => '<i class="glyphicon glyphicon-remove"></i>'
        ],
        'headerOptions' => ['class' => 'kartik-sheet-style'],
    ]

];
?>

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
    'export' => false,
    'responsive' => true,
    'hover' => true,
    //'pjax' => true, // pjax is set to always true for this demo
    'columns' => $gridColumns,
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-upload"></i> ' . ucfirst(strtolower($case_name)) . ' Uploads</h3>',
        'type' => 'success',
        'footer' => false
    ],
]); ?>
<?php \yii\widgets\Pjax::end(); ?>

