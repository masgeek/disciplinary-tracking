<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $tracking \app\modules\reporting\models\TRACKING_MODEL */
/* @var $process_actor \app\modules\reporting\models\PROCESS_ACTOR_MODEL */
/* @var $incidence \app\models\STUDENT_INCIDENCE */
/* @var $form yii\widgets\ActiveForm */

$case_name = \app\modules\reporting\models\CASE_MODEL_VIEW::GetCaseName($incidence->CASE_TYPE_ID);

$p = \app\modules\reporting\models\TRACKING_MODEL::GetFirstProcess($incidence->CASE_TYPE_ID);

var_dump($p);
?>
<h1>progress/first-office</h1>

<div class="progress-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($tracking, 'INCIDENCE_ID')->textInput(['value' => $incidence->INCIDENCE_ID]) ?>
    <?= $form->field($tracking, 'PROCESS_ID')->textInput(['value' => $incidence->INCIDENCE_ID]) ?>
    <?= $form->field($process_actor, 'PROCESS_ACTOR_ID')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>