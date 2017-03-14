<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CASE_TYPE_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="case-type-model-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'DISCIPLINARY_TYPE_ID')->dropDownList(\app\models\DISCIPLINARY_TYPE_MODEL::GetDisciplinaryTypeList()) ?>

    <?= $form->field($model, 'CASE_TYPE_NAME')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
