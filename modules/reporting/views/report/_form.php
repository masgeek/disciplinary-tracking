<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\modules\reporting\models\CASE_INCIDENCE_MODEL */
/* @var $uploads \app\modules\tracking\models\FILEUPLOAD */
/* @var $student_case \app\models\STUDENT_INCIDENCE */
/* @var $form yii\widgets\ActiveForm */
$description = null;
if (!$model->isNewRecord) {
    $t = gettype($model->CASE_DESCRIPTION);
    if ($t == 'resource') {
        $description = stream_get_contents($model->CASE_DESCRIPTION);
    } else {
        $description = $model->CASE_DESCRIPTION;
    }
}
$studentInfoUrl = \yii\helpers\Url::toRoute(['//student-info']);
$studentList = \app\modules\reporting\models\CASE_INCIDENCE_MODEL::GetStudentsList();
$faculties = \app\modules\tracking\extended\FACULTY_MODEL::GetFaculties();
$case_list = \app\modules\tracking\extended\CASE_TYPE_MODEL::GetCaseTypesList($student_case->DISCIPLINARY_TYPE_ID, true);
$student_status = \app\modules\tracking\extended\STATUS_MODEL::GetStatusList();

$user_id = Yii::$app->user->identity->username;

?>

<div class="incidence_model-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($student_case, 'DISCIPLINARY_TYPE_ID')
                ->dropDownList($case_list, ['disabled' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'STUDENT_REG_NO')->widget(\kartik\select2\Select2::classname(), [
                'data' => $studentList,
                'options' => ['placeholder' => '---SELECT STUDENT---', 'id' => 'student'],
                'theme' => \kartik\select2\Select2::THEME_BOOTSTRAP, // this is the default if theme is not set
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'CASE_DESCRIPTION')->textarea(['rows' => 6, 'value' => $description]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <!--?= $form->field($model, 'STATUS_CODE')
                ->dropDownList($student_status, ['prompt' => 'Select student status', 'readonly' => true]) ?-->
            <?= $form->field($model, 'STATUS_CODE')->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => 'student-status'],
                'pluginOptions' => [
                    'depends' => ['student'],
                    'placeholder' => 'Select...',
                    'url' => \yii\helpers\Url::toRoute(['//student-status'])
                ]
            ]) ?>
        </div>
        <div class="col-md-4">
            <!--?= $form->field($model, 'FACULTY_CODE')
                ->dropDownList($faculties, ['prompt' => '---FACULTY---', 'readonly' => true, 'id' => 'faculty']) ?-->
            <?= $form->field($model, 'FACULTY_CODE')->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => 'faculty'],
                'pluginOptions' => [
                    'depends' => ['student'],
                    'placeholder' => 'Select...',
                    'url' => \yii\helpers\Url::toRoute(['//faculty-info'])
                ]
            ]) ?>
        </div>
        <div class="col-md-2">
            <!--?= $form->field($model, 'COLLEGE_CODE')
                ->dropDownList($faculties, ['prompt' => '---COLLEGE---', 'readonly' => true]) ?-->
            <?= $form->field($model, 'COLLEGE_CODE')->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => 'college'],
                'pluginOptions' => [
                    'depends' => ['faculty'],
                    'placeholder' => 'Select...',
                    'url' => \yii\helpers\Url::toRoute(['//college-info'])
                ]
            ]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'REPORTED_BY')->textInput(['value' => $user_id, 'readonly' => true]) ?>
        </div>
    </div>
    <?= $form->field($student_case, 'CASE_TYPE_ID')->hiddenInput(['readonly' => true])->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit Incidence') : Yii::t('app', 'Update Incidence'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
