<?php
/* @var $this SysActionController */
/* @var $model SysAction */

$this->breadcrumbs=array(
    Yii::t('app', 'Configuration'),
    Yii::t('app', 'Action') => array('admin'),
    Yii::t('app', 'Add') => array('create'),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Add Action') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_form', array('model' => $model, 'modelList' => $modelList)); ?></div>
</div>