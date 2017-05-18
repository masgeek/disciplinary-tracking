<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\reporting\models\CASE_INCIDENCE_MODEL */

$this->title = 'Incidence Reporting |' . $model->INCIDENCE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Case Incidences'), 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View Incidence Details';
?>
<div class="incidence--model-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->INCIDENCE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Add to Incidence'), ['//add-case', 'incidence_id' => $model->INCIDENCE_ID], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Delete Incidence'), ['delete', 'id' => $model->INCIDENCE_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'INCIDENCE_ID',
            'STUDENT_REG_NO',
            'DATE_REPORTED',
            [
                'label' => 'Name',
                'type' => 'ntext',
                'value' => function ($row) {
                    $t = gettype($row->CASE_DESCRIPTION);
                    if ($t == 'resource') {
                        $description = stream_get_contents($row->CASE_DESCRIPTION);
                    } else {
                        $description = $row->CASE_DESCRIPTION;
                    }
                    return $description;
                }
            ],
            //'CASE_DESCRIPTION:ntext',
            //'STATUS_CODE',
            'sTATUSCODE.STATUS_DESCRIPTION',
            'REPORTED_BY',
        ],
    ]) ?>


</div>
