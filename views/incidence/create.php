<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\INCIDENCE_MODEL */

$this->title = Yii::t('app', 'Create Incidence  Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Incidence  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incidence--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
