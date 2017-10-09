<?php
/* @var $this EditablesController */
/* @var $model Editables */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'editables-form',
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
    <?php echo $form->labelEx($model, 'editable_text', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'editable_text', array('class' => 'form-control', 'maxlength' => 255)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'editable_text'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'editable_textarea', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textArea($model, 'editable_textarea', array('class' => 'form-control', 'rows' => 6)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'editable_textarea'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'editable_select', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropDownList($model, 'editable_select', SysModule::model()->getModuleList(), array('class' => 'select2', 'maxlength' => 50)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'editable_select'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'editable_select2', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropDownList($model, 'editable_select2', SysModule::model()->getModuleList(), array('class' => 'select2', 'multiple' => 'multiple')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'editable_select2'); ?>
    </div>
</div>

<?php $model->editable_checkbox = explode(',', $model->editable_checkbox); ?>        
<div class="form-group">
    <?php echo $form->labelEx($model, 'editable_checkbox', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->checkBoxList($model, 'editable_checkbox', SysModule::model()->getModuleList()) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'editable_checkbox'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'editable_date', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-2">
        <div class="input-group date">
        <?php echo $form->textField($model, 'editable_date', array('class' => 'form-control text-center')); ?>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
    </div>
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo $form->error($model, 'editable_date'); ?>
    </div>
</div>


<div class="form-group">
    <?php echo $form->labelEx($model, 'is_delete', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->checkBox($model, 'is_delete', array('class' => 'make-switch-yesno')) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'is_delete'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::resetButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl('editables/admin'), array('class' => 'btn btn-default')) ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<!-- form -->