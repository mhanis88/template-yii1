<?php
/* @var $this SysModuleController */
/* @var $model SysModule */

$this->breadcrumbs=array(
    Yii::t('app', 'Configuration'),
    Yii::t('app', 'Module') => array('admin'),
    Yii::t('app', 'Update') => array('update', 'id' => $model->module_id),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Update Module') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_form', array('model' => $model)); ?></div>
</div>