<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DISCIPLINARY_TYPE_MODEL */

$this->title = $model->DISCIPLINARY_TYPE_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disciplinary  Type  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplinary--type--model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->DISCIPLINARY_TYPE_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->DISCIPLINARY_TYPE_ID], [
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
            'DISCIPLINARY_TYPE_ID',
            'DISCIPLINARY_TYPE_NAME',
        ],
    ]) ?>

</div>
