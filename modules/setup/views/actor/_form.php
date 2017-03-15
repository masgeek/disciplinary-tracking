<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\ACTOR_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actor--model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ACTOR_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EMAIL_ADDRESS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ACTIVE')->dropDownList([0=>'Inactive', 1=>'Active'],['prompt'=>"Please Select"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
