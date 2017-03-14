<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $form yii\widgets\ActiveForm */
/* @var $incidence_id */
?>

<div class="user-uploads-form">

    <?php $form = ActiveForm::begin(); ?>

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
                'INCIDENCE_ID' => $incidence_id,
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
    <?php ActiveForm::end(); ?>

</div>
