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
        'attribute' => 'REGISTRATION_NUMBER',
        'width' => '100%',
        'value' => function ($model, $key, $index, $widget) {
            $reg_no = $model['REGISTRATION_NUMBER'];
            $student_model = \app\modules\tracking\extended\STUDENT_MODEL::findOne($reg_no);
            if ($student_model != null) {
                $names = $student_model->SURNAME;
                $names .= ' ';
                $names .= $student_model->OTHER_NAMES;
                $student = "$reg_no - $names";
            } else {
                $student = $reg_no;
            }
            return $student;
        },
        'filterInputOptions' => ['placeholder' => 'Type payroll number'],
        'group' => true,  // enable grouping,
        'groupedRow' => true,                    // move grouped column to a single grouped row
        'groupOddCssClass' => 'kv-grouped-row',  // configure odd group cell css class
        'groupEvenCssClass' => 'kv-grouped-row', // configure even group cell css class
    ],
    [
        'class' => 'kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },

        'allowBatchToggle' => false,
        'expandOneOnly' => true,
        'expandTitle' => 'Click to view comments about the submission',
        'expandIcon' => '<span class="fa fa-comment-o"></span>',
        'collapseIcon' => '<span class="fa fa-comment"></span>',
        'detail' => function ($model) {
            $tracking_id = $model['ID'];
            $comments_model = new \app\modules\reporting\models\TRACKING_MODEL();
            $comments_model->TRACKING_ID = $tracking_id;
            $dataProvider = $comments_model->LoadComments($tracking_id);
            return Yii::$app->controller->renderPartial('_expand_row', [
                'dataProvider' => $dataProvider,
            ]);
        },

        'detailOptions' => [
            //'class' => 'kv-state-enable',
        ],

    ],
    [
        'attribute' => 'EVENT_NAME',
        'value' => 'EVENT_NAME',
        //'group' => false,  // enable grouping
        //'subGroupOf' => 1,
        'visible' => false
    ],
    [
        'attribute' => 'EVENT_DETAIL_NAME',
        'value' => 'EVENT_DETAIL_NAME',
        //'group' => false,  // enable grouping
        //'subGroupOf' => 2
    ],

    [
        'attribute' => 'SUPERVISOR_APPROVED',
        'value' => function ($data) {
            if ($data['SUPERVISOR_APPROVED']) {
                return 1;
            }
            return 0;
        },
        'format' => 'boolean'
    ],
    [
        'attribute' => 'DATE_SUBMITTED',
        'format' => 'datetime',
        'value' => function ($data) {
            $date_time = \app\component\DATA_FACTORY::TimeStampToDateTime($data['SUBMISSION_TIME']);
            return $date_time;
        },
    ],
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
    ],
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
                    'ACTION' => 'APPROVE',
                    'ID' => $model['ID'],
                    'TIMESTAMP' => $model['SUBMISSION_TIME'],
                    'EVENT_DETAIL_ID' => $model['EVENT_DETAIL_ID'],
                    'REGISTRATION_NUMBER' => $model['REGISTRATION_NUMBER'],
                    '_csrf' => Yii::$app->request->csrfToken
                ],
                'class' => 'btn btn-success btn-xs btn-block']);
        },
    ],
];
// the GridView widget (you must use kartik\grid\GridView)

//show the gridview
?>
<?= Html::a('Return to Dashboard', ['//supervisor-actions'], ['class' => 'btn btn-primary']) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    //'filterModel' => $searchModel,
    'export' => false,
    'columns' => $gridColumns,
    'responsive' => true,
    'hover' => true,
    'toggleData' => true,
]); ?>