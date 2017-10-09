<?php
/* @var $this SysControllerController */
/* @var $model SysController */

$this->breadcrumbs=array(
    Yii::t('app', 'Configuration'),
    Yii::t('app', 'Controller') => array('admin'),
    Yii::t('app', 'Add') => array('create'),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Add Controller') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_form', array('model' => $model)); ?></div>
</div>