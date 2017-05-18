<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;
?>
    <h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_progress_grid', ['dataProvider' => $dataProvider]); ?>