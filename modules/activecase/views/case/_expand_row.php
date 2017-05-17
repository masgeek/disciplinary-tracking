<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 04-May-17
 * Time: 13:44
 *
 * @var $dataProvider \yii\data\ActiveDataProvider
 */


$GridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    //'ID',
    'SOURCE',
    'COMMENTS',
    [
        //lets build the document link
        'header' => 'Document',
        'attribute' => 'SOURCE',
        'format' => 'raw',
        'value' => function ($model, $key, $index) {
            /* @var $model \app\modules\extended\COMMENTS_MODEL */
            /* @var $file \app\modules\extended\UPLOADED_FILES_MODEL */
            //$file_url = '#';
            $file = $model->dOCUMENT;

            if ($file == null) {
                //no files
                return 'No Document';
            }
            $path = $file->FILE_PATH . '/' . $file->FILE_NAME;

            if (strpos($path, "http://") !== false || strpos($path, "https://") !== false) {
                //do not suffix
                $file_url = $path;
            } else {
                $file_url = '//' . $path;
            }
            return "<a href='$file_url' target='_blank' class='btn btn-danger btn-xs btn-block'>Download Document <span class='glyphicon glyphicon-download'></span></a>";

        }
    ],
    [
        'attribute' => 'TIMESTAMP',
        'format' => 'datetime'
    ]
];
?>

<?= \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'export' => false,
    'columns' => $GridColumns,
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'responsive' => true,
    'bordered' => true,
    'striped' => true,
    'condensed' => true,
    'hover' => true,
    /*'showPageSummary'=>false,
    'panel'=>[
        'type'=>\kartik\grid\GridView::TYPE_PRIMARY,
        //'heading'=>$heading,
    ],
   'persistResize'=>false,*/
]); ?>