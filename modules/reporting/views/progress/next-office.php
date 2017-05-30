<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $tracking \app\modules\reporting\models\TRACKING_MODEL */
/* @var $process_actor \app\modules\reporting\models\PROCESS_ACTOR_MODEL */
/* @var $nextProcess \app\modules\setup\models\PROCESS_MODEL */
/* @var $incidence \app\models\STUDENT_INCIDENCE */
/* @var $form yii\widgets\ActiveForm */

$faculty_code = 'S08';//$incidence->iNCIDENCE->FACULTY_CODE;

$case_name_arr = \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseNameArray($incidence->INCIDENCE_ID);


$process_exclusion_arr = \app\modules\reporting\models\TRACKING_MODEL::GetTrackedProcesses($incidence->INCIDENCE_ID);

$nextProcess = \app\modules\setup\models\PROCESS_MODEL::GetNextTrackingProcess($incidence->CASE_TYPE_ID, false, $process_exclusion_arr);

$process_actors = \app\modules\reporting\models\PROCESS_ACTOR_MODEL::GetProcessActors($nextProcess->PROCESS_ID, $faculty_code, true);

$this->title = $nextProcess->PROCESS_NAME;
$this->params['breadcrumbs'][] = ['label' => 'Pending Cases', 'url' => ['//pending-cases']];
$this->params['breadcrumbs'][] = 'Forward Case to next office';
$this->params['breadcrumbs'][] = $this->title;

?>
<h3><?= $nextProcess->DESCRIPTION ?></h3>

<div class="progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($incidence, 'CASE_TYPE_ID')->dropDownList($case_name_arr)->label(false) ?>
    <?= $form->field($tracking, 'INCIDENCE_ID')->hiddenInput(['value' => $incidence->INCIDENCE_ID])->label(false) ?>
    <?= $form->field($tracking, 'PROCESS_ID')->hiddenInput(['value' => $nextProcess->PROCESS_ID])->label(false) ?>
    <?= $form->field($process_actor, 'PROCESS_ACTOR_ID')
        ->dropDownList($process_actors, [
            'prompt' => '---SELECT OFFICE ACTOR---',
            'onchange' => 'forwardingOffice(this)'
        ]) ?>
    <?= $form->field($tracking, 'COMMENTS')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton("Forward Case", ['id' => 'btn-forward', 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    function forwardingOffice($dropdown) {
        var $forwardText = 'Forward Case';
        var officeActor = $($dropdown).find("option:selected").text();

        console.log(!!$dropdown.value); //will be true if empty
        if (!!$dropdown.value) {
            $forwardText = 'Forward to ' + officeActor;
        } else {
        }

        $('#btn-forward').text($forwardText);
    }
</script>