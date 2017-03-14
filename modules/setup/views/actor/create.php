<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\ACTOR_MODEL */

$this->title = 'Create Actor  Model';
$this->params['breadcrumbs'][] = ['label' => 'Actor  Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actor--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
