<?php
/* @var $this EditablesController */
/* @var $model Editables */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
)); ?>

<div class="form-group">
    <?php echo $form->label($model,'editable_id',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'editable_id',array('class'=>'form-control','maxlength'=>50)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'editable_text',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'editable_text',array('class'=>'form-control','maxlength'=>255)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'editable_textarea',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textArea($model,'editable_textarea',array('class'=>'form-control','rows'=>6)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'editable_select',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'editable_select',array('class'=>'form-control','maxlength'=>50)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'editable_select2',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textArea($model,'editable_select2',array('class'=>'form-control','rows'=>6)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'editable_checkbox',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'editable_checkbox',array('class'=>'form-control','maxlength'=>50)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'editable_date',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'editable_date',array('class'=>'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'record_date',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'record_date',array('class'=>'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'update_date',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'update_date',array('class'=>'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model,'is_delete',array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model,'is_delete',array('class'=>'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Search'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::submitButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default', 'onclick' => 'js:$(".select2-selection__rendered").attr("title","'. Yii::t('app','-- All --') .'").text("'. Yii::t('app','-- All --') .'"); $(this).closest("form").trigger("reset");')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<!-- search-form -->