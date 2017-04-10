<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $tracking \app\modules\reporting\models\TRACKING_MODEL */
/* @var $process_actor \app\modules\reporting\models\PROCESS_ACTOR_MODEL */
/* @var $nextProcess \app\modules\setup\models\PROCESS_MODEL */
/* @var $incidence \app\models\STUDENT_INCIDENCE */
/* @var $form yii\widgets\ActiveForm */

$case_name_arr = \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseNameArray($incidence->INCIDENCE_ID);


$process_exclusion_arr = \app\modules\reporting\models\TRACKING_MODEL::GetTrackedProcesses($incidence->INCIDENCE_ID);

$nextProcess = \app\modules\setup\models\PROCESS_MODEL::GetNextTrackingProcess($incidence->CASE_TYPE_ID, false, $process_exclusion_arr);

$process_actors = \app\modules\reporting\models\PROCESS_ACTOR_MODEL::GetProcessActors($nextProcess->PROCESS_ID, true);

var_dump($nextProcess);
?>
<h1>progress/first-office</h1>

<div class="progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($incidence, 'CASE_TYPE_ID')->dropDownList($case_name_arr)->label(false) ?>
    <?= $form->field($tracking, 'INCIDENCE_ID')->hiddenInput(['value' => $incidence->INCIDENCE_ID])->label(false) ?>
    <?= $form->field($tracking, 'PROCESS_ID')->hiddenInput(['value' => $nextProcess->PROCESS_ID])->label(false) ?>
    <?= $form->field($process_actor, 'PROCESS_ACTOR_ID')
        ->dropDownList($process_actors, ['prompt' => 'Select Office Actor'])
    ?>
    <?= $form->field($tracking, 'COMMENTS')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Foward Case'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>