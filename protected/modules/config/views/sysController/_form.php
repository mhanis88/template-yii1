<?php
/* @var $this SysControllerController */
/* @var $model SysController */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'sys-controller-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'module_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropDownList($model, 'module_id', SysModule::model()->getModuleList(), array('empty' => Yii::t('app','-- Select --'), 'class' => 'form-control select2')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'module_id'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'controller_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'controller_name', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'controller_name'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::resetButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/admin'),  array('class' => 'btn btn-default')) ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<!-- form -->