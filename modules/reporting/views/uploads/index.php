<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\search\UploadsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Uploads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-uploads-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Uploads'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'UPLOAD_ID',
            'USER_ID',
            'FILE_PATH',
            'COMMENTS:ntext',
            'PUBLICLY_AVAILABLE',
            // 'DATE_UPLOADED',
            // 'UPDATED',
            // 'DELETED',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
