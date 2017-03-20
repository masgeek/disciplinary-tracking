<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\reporting\models\PROCESS_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="process--model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CASE_TYPE_ID')->textInput() ?>

    <?= $form->field($model, 'PROCESS_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ORDER_NO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
