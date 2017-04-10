<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LOGINFORM */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-md-8 col-md-offset-2">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        //'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            //'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <div class="row">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false)->hint('Payroll Number') ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'password')->passwordInput()->label(false)->hint('Password') ?>
    </div>
    <!--= $form->field($model, 'rememberMe')->checkbox([
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ]) ?-->


    <div class="row">
        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
    </div>


    <?php ActiveForm::end(); ?>

    <div class="row">
        <div class="col-lg-offset-1" style="color:#999;">
            You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        </div>
    </div>
</div>
