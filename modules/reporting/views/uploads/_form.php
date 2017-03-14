<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-uploads-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'INCIDENCE_ID')->textInput() ?>

    <?= $form->field($model, 'FILE_SELECTOR')->widget(\kartik\file\FileInput::className(), [
        'options' => [
            //'accept' => 'image/*',
            'multiple' => false
        ],
        'pluginOptions' => [
            'allowedFileExtensions' => ['jpg', 'jpeg', 'gif', 'png', 'pdf', 'docx', 'rtf', 'odt'],
            'maxFileCount' => 10,
            'uploadAsync' => true,
            'showPreview' => false,
            //'showUpload' => false,
            'uploadExtraData' => [
                'INCIDENCE_ID' => $model->INCIDENCE_ID,
                '_csrf' => Yii::$app->request->csrfToken
            ],
            'uploadUrl' => \yii\helpers\Url::to(['//report/uploads/file-upload']),
        ],
        'pluginEvents' => [
            'fileuploaded' => "function(event, data, previewId, index){
                console.log(data.filenames);
                console.log(data.response.path);
            }" //after uploading enable the submit button
        ]
    ]); ?>
    <?= $form->field($model, 'FILE_PATH')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'FILE_NAME')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
