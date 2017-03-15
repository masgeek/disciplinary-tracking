<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $incidence_id */
/* @var $case_type_id */

$session = Yii::$app->session;

$case_type_id = $session->get('CASE_TYPE_ID');
$incidence_id = $session->get('INCIDENCE_ID');


$this->title = Yii::t('app', 'Incidence Uploads');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-uploads-create row">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'incidence_id' => $incidence_id
    ]) ?>

    <?= $this->render('_file-grid', [
        'dataProvider' => $dataProvider,
        'case_type_id' => $case_type_id
    ]) ?>
</div>

<!-- add foward next button -->
<?= Html::a(Yii::t('app', 'Forward to Next Office'), [
    '//report/progress/first-office'], [
    'data' => [
        //'confirm' => 'Are you sure',
        'method' => 'post',
        'params' => [
            'INCIDENCE_ID' => $incidence_id
        ]
    ],
    'class' => 'btn btn-default btn-lg btn-block',
]) ?>
