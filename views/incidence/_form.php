<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\INCIDENCE_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="incidence--model-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'STUDENT_REG_NO')->dropDownList(\app\models\INCIDENCE_MODEL::GetStudentsList()) ?>

    <!--?= $form->field($model, 'DATE_REPORTED')->textInput(['maxlength' => true]) ?-->
    <?= $form->field($model, 'DATE_REPORTED')->widget(\kartik\date\DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter reporting date ...'],
        'pluginOptions' => [
            'autoclose' => true,
            //'format' => 'yyyy-dd-M hh:ii'
            'format' => 'dd-M-yyyy',
            'todayHighlight' => true,
            'todayBtn' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'CASE_DESCRIPTION')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'STATUS_CODE')->dropDownList(\app\models\STATUS_MODEL::GetStatusList()) ?>

    <?= $form->field($model, 'REPORTED_BY')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
