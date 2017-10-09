<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    Yii::t('app', 'Editable'),
    Yii::t('app', 'Detail View') => array('create1'),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Detail View') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_form1', array('model' => $model)); ?></div>
</div>