<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\ACTOR_MODEL */

$this->title = 'Update Actor  Model: ' . $model->ACTOR_ID;
$this->params['breadcrumbs'][] = ['label' => 'Actor  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ACTOR_ID, 'url' => ['view', 'id' => $model->ACTOR_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="actor--model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
