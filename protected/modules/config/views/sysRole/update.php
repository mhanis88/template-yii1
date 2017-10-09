<?php
/* @var $this SysRoleController */
/* @var $model SysRole */

$this->breadcrumbs=array(
    Yii::t('app', 'Configuration'),
    Yii::t('app', 'Role') => array('admin'),
    Yii::t('app', 'Update') => array('update', 'id' => $model->role_id),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Update Role') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_form', array('model' => $model, 'access' => $access, 'menu' => $menu)); ?></div>
</div>