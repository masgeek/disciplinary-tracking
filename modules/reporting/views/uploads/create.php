<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $incidence_id*/

$this->title = Yii::t('app', 'Incidence Uploads');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Uploads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-uploads-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'incidence_id'=>$incidence_id
    ]) ?>

    <?= $this->render('_file-grid', [
        'dataProvider' => $dataProvider,
    ]) ?>
</div>
