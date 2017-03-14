<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CASE_TYPE_MODEL */

$this->title = Yii::t('app', 'Create Case  Type  Model');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Case  Type  Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case--type--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
