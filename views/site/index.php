<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>University of Nairobi</h1>

        <p class="lead">Welcome to the Disciplinary Tracking System</p>

        <p><a class="btn btn-lg btn-success" href="#">Select an item below to get started</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Report Incident</h2>

                <p>Report exam disciplinary incidences</p>

                <p><?=\yii\helpers\Html::a(Yii::t('app', 'Report Incidence'), ['//report/report/report-case'], ['class' => 'btn btn-primary btn-block'])?></p>
            </div>
            <div class="col-lg-4">
                <h2>View Case Progress</h2>

                <p>View reported cases progress</p>

                <p><?=\yii\helpers\Html::a(Yii::t('app', 'Case Progress'), ['//case-progress'], ['class' => 'btn btn-default btn-block'])?></p>

            </div>
            <div class="col-lg-4">
                <h2>Pending Approvals</h2>

                <p>View Cases Pending Approvals</p>

                <p><a class="btn btn-success btn-block" href="#">Click to Proceed</a></p>
            </div>
        </div>

    </div>
</div>
