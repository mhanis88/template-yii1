<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
)); ?>

<div class="form-group">
    <?php echo $form->label($model,'user_id',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'user_id',array('class'=>'form-control','maxlength'=>50)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'user_username',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'user_username',array('class'=>'form-control','maxlength'=>128)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'email',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'email',array('class'=>'form-control','maxlength'=>128)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'role_id',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'role_id',array('class'=>'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'reset_request',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'reset_request',array('class'=>'form-control','maxlength'=>20)); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Find'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::submitButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default', 'onclick' => 'js:$(this).closest("form").find(".select2-selection__rendered").attr("title","'. Yii::t('app','-- All --') .'").text("'. Yii::t('app','-- All --') .'"); $(this).closest("form").trigger("reset");')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<!-- search-form -->