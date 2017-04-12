<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DISCIPLINARY_TYPE_MODEL */

$this->title = Yii::t('app', 'Create Disciplinary Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Disciplinary Type'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="disciplinary--type--model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
