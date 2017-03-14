<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\reporting\models\UPLOAD_MODEL */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Uploads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-uploads-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Uploads'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= $this->render('_file-grid', ['dataProvider' => $dataProvider]) ?>
</div>
