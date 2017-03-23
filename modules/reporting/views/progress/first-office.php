<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $tracking \app\modules\reporting\models\TRACKING_MODEL */
/* @var $process_actor \app\modules\reporting\models\PROCESS_ACTOR_MODEL */
/* @var $incidence \app\models\STUDENT_INCIDENCE */
/* @var $form yii\widgets\ActiveForm */

$case_name_arr = \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseNameArray($incidence->INCIDENCE_ID);

$p = \app\modules\setup\models\PROCESS_MODEL::GetNextTrackingProcess($incidence->CASE_TYPE_ID, false);
?>
<h1>progress/first-office</h1>

<div class="progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($incidence, 'CASE_TYPE_ID')->dropDownList($case_name_arr) ?>
    <?= $form->field($tracking, 'INCIDENCE_ID')->textInput(['value' => $incidence->INCIDENCE_ID]) ?>
    <?= $form->field($tracking, 'PROCESS_ID')->textInput(['value' => $p->PROCESS_ID]) ?>
    <?= $form->field($process_actor, 'PROCESS_ACTOR_ID')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>