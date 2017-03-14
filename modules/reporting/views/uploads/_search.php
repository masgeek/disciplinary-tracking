<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\search\UploadsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-uploads-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'UPLOAD_ID') ?>

    <?= $form->field($model, 'USER_ID') ?>

    <?= $form->field($model, 'FILE_PATH') ?>

    <?= $form->field($model, 'COMMENTS') ?>

    <?= $form->field($model, 'PUBLICLY_AVAILABLE') ?>

    <?php // echo $form->field($model, 'DATE_UPLOADED') ?>

    <?php // echo $form->field($model, 'UPDATED') ?>

    <?php // echo $form->field($model, 'DELETED') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
