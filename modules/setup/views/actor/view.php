<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\ACTOR_MODEL */

$this->title = $model->ACTOR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actor  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actor--model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ACTOR_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ACTOR_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ACTOR_ID',
            'ACTOR_NAME',
            'EMAIL_ADDRESS:email',
            'ACTIVE',
        ],
    ]) ?>

</div>
