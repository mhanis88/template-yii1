<?php
/* @var $this MaintenanceController */
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Under Maintenance');
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/<?php echo Yii::app()->params['bootstrap'] ?>/<?php echo Yii::app()->params['bootstrapTheme'] ?>/css/bootstrap.css" />
<div>&nbsp;</div>
<div class="container text-center">
    <div class="jumbotron">
        <h1>This site is currently Under Maintenance</h1>
        <p>Please visit back at a later time. Thank you!</p>
    </div>
</div>