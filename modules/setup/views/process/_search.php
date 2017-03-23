<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\Processsearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="process--model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?//= //$form->field($model, 'PROCESS_ID') ?>

    <?//= //$form->field($model, 'CASE_TYPE_ID') ?>

    <?//= //$form->field($model, 'PROCESS_NAME') ?>

    <?//= //$form->field($model, 'DESCRIPTION') ?>

    <?//= //$form->field($model, 'ORDER_NO') ?>

    <?//php // echo $form->field($model, 'DATE_ADDED') ?>

    <?//php // echo $form->field($model, 'DATE_MODIFIED') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
