<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\reporting\models\PROCESS_MODEL */

$this->title = $model->PROCESS_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Process  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="process--model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->PROCESS_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->PROCESS_ID], [
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
            'PROCESS_ID',
            'CASE_TYPE_ID',
            'PROCESS_NAME',
            'DESCRIPTION',
            'ORDER_NO',
            'DATE_ADDED',
            'DATE_MODIFIED',
        ],
    ]) ?>

</div>
