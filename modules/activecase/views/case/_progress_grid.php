<?php
/* @var $this yii\web\View */
/* @var $model \app\modules\reporting\models\CASE_INCIDENCE_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\dialog\Dialog;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute' => 'STUDENT_REG_NO',
        //'width' => '100%',
        'value' => function ($model, $key, $index, $widget) {
            /* @var $model \app\modules\reporting\models\CASE_INCIDENCE_MODEL */
            $reg_no = $model->STUDENT_REG_NO;
            $student_model = \app\modules\tracking\extended\STUDENT_MODEL::findOne($reg_no);
            return $student_model != null ? $student_model->getRegFullName() : $reg_no;
        },
        'group' => true,  // enable grouping,
        'groupedRow' => false,                    // move grouped column to a single grouped row
        'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index, $column) {
            //return GridView::ROW_COLLAPSED;
            return GridView::ROW_EXPANDED;
        },

        'allowBatchToggle' => false,
        'expandOneOnly' => false,
        'expandIcon' => '<span class="fa fa-folder"></span>',
        'collapseIcon' => '<span class="fa fa-folder-open"></span>',
        'detail' => function ($model) {
            /* @var $model \app\modules\reporting\models\CASE_INCIDENCE_MODEL */
            $incidence_id = $model->INCIDENCE_ID;
            $tracking = new \app\modules\reporting\models\TRACKING_MODEL();
            $dataProvider = $tracking->search($incidence_id);

            return Yii::$app->controller->renderPartial('_expand_row', [
                'dataProvider' => $dataProvider,
            ]);
        },

        'detailOptions' => [
            //'class' => 'kv-state-enable',
        ],

    ],
    [
        'attribute' => 'REPORTED_BY',
        'value' => 'REPORTED_BY',
        //'group' => false,  // enable grouping
        //'subGroupOf' => 1,
        'visible' => false
    ],
    [
        'attribute' => 'REPORTED_BY',
        'value' => 'REPORTED_BY',
        //'group' => false,  // enable grouping
        //'subGroupOf' => 2
    ],

    [
        'attribute' => 'REPORTED_BY',
        'value' => function ($data) {
            if ($data->REPORTED_BY) {
                return 1;
            }
            return 0;
        },
        'format' => 'boolean'
    ],
    [
        'attribute' => 'DATE_REPORTED',
        'format' => 'date',
        'value' => function ($data) {
            $date_time = \app\components\DATA_FACTORY::StringToDateTime($data->DATE_REPORTED);
            return $date_time;
        },
    ],
    /*
    [
        //lets build the document link
        'header' => 'Document',
        'attribute' => 'FILE_NAME',
        'format' => 'raw',
        'value' => function ($model, $key, $index) {
            //$file_url = '#';
            if (strlen($model['FILE_PATH']) <= 0) {
                //no files
                return 'No Document';
            }
            $path = $model['FILE_PATH'] . '/' . $model['FILE_NAME'];

            if (strpos($path, "http://") !== false || strpos($path, "https://") !== false) {
                //do not suffix
                $file_url = $path;
            } else {
                $file_url = '//' . $path;
            }
            return "<a href='$file_url' target='_blank'>Download <span class='glyphicon glyphicon-download'></span></a>";
        }
    ],*/
    // Action column
    [
        'class' => '\kartik\grid\ActionColumn',
        'template' => '{approve}',
        'buttons' => [
            'approve' => function ($url, $model, $key) {
                return $url;
            },
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            /* @var $model \app\modules\reporting\models\CASE_INCIDENCE_MODEL */
            $url = '#';
            if ($action === 'approve') {
                $action = 'Act On Submission';
                $url = \yii\helpers\Url::toRoute(['//sup-action']);
            }

            return Html::a($action, $url, [
                'data-method' => 'post',
                //'data-confirm' => 'Are you sure?',
                'id' => 'act-btn',
                'data-params' => [
                    'ID' => $model->INCIDENCE_ID,
                    '_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-success btn-xs btn-block']);
        },
    ],
];
// the GridView widget (you must use kartik\grid\GridView)

//show the gridview
?>
<?= Html::a('Return to Dashboard', ['//case-progress'], ['class' => 'btn btn-primary']) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'export' => false,
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'toggleData' => true,
]); ?>