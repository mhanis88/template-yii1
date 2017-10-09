<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
)); ?>

<p class="note"><?php echo Yii::t('app', 'Fields with <span class="required">*</span> are required.') ?></p>

<?php echo $form->errorSummary($model); ?>

        
<div class="form-group">
    <?php echo $form->labelEx($model,'user_id',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'user_id',array('class'=>'form-control','maxlength'=>50)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'user_id'); ?>
    </div>
</div>
        
        
<div class="form-group">
    <?php echo $form->labelEx($model,'user_username',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'user_username',array('class'=>'form-control','maxlength'=>128)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'user_username'); ?>
    </div>
</div>
        
        
<div class="form-group">
    <?php echo $form->labelEx($model,'user_password',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'user_password',array('class'=>'form-control','maxlength'=>60)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'user_password'); ?>
    </div>
</div>
        
        
<div class="form-group">
    <?php echo $form->labelEx($model,'email',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'email',array('class'=>'form-control','maxlength'=>128)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'email'); ?>
    </div>
</div>
        
        
<div class="form-group">
    <?php echo $form->labelEx($model,'role_id',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'role_id',array('class'=>'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'role_id'); ?>
    </div>
</div>
        
        
<div class="form-group">
    <?php echo $form->labelEx($model,'reset_request',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'reset_request',array('class'=>'form-control','maxlength'=>20)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'reset_request'); ?>
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