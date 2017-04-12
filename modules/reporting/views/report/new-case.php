<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/14/2017
 * Time: 20:47
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\models\STUDENT_INCIDENCE */
/* @var $form yii\widgets\ActiveForm */

//now for the active form
?>

<div class="col-md-8 col-md-offset-2">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'DISCIPLINARY_TYPE_ID')
        ->dropDownList(\app\modules\tracking\extended\DISCIPLINARY_TYPE_MODEL::GetDisciplinaryTypeList(), ['prompt' => 'Select Case...', 'id' => 'disc_case']) ?>

    <?= $form->field($model, 'CASE_TYPE_ID')->widget(\kartik\depdrop\DepDrop::classname(), [
        'options' => ['id' => 'case_type_id'],
        'pluginOptions' => [
            'depends' => ['disc_case'], //depends on th above dropdown :-)
            'placeholder' => 'Select case type...',
            'url' => \yii\helpers\Url::to(['case-types'])
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Next >>', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>