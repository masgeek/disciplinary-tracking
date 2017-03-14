<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UploadsModel */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Uploads',
]) . $model->UPLOAD_ID;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->UPLOAD_ID, 'url' => ['view', 'id' => $model->UPLOAD_ID]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-uploads-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
