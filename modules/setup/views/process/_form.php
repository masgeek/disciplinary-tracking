<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\setup\models\PROCESS_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="process--model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'DISC_TYPE_ID')
        ->dropDownList(\app\models\DISCIPLINARY_TYPE_MODEL::GetDisciplinaryTypeList(), ['prompt' => 'Select Case...', 'id' => 'disc_case']) ?>

    <?= $form->field($model, 'CASE_TYPE_ID')->widget(\kartik\depdrop\DepDrop::classname(), [
        'options' => ['id' => 'case_type_id'],
        'pluginOptions' => [
            'depends' => ['disc_case'], //depends on th above dropdown :-)
            'placeholder' => 'Select case type...',
            'url' => \yii\helpers\Url::to(['//report/report/case-types'])
        ]
    ]); ?>
    <?= $form->field($model, 'PROCESS_NAME')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCRIPTION')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'ORDER_NO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
