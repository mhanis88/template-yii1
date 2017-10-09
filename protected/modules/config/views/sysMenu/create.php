<?php
/* @var $this SysMenuController */
/* @var $model SysMenu */

$this->breadcrumbs=array(
    Yii::t('app', 'Configuration'),
    Yii::t('app', 'Menu') => array('admin'),
    Yii::t('app', 'Add') => array('create'),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Add Menu') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_form', array('model' => $model)); ?></div>
</div>