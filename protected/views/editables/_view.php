<?php
/* @var $this EditablesController */
/* @var $data Editables */
?>

<form class="form-horizontal">
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_id',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_id; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_text',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_text; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_textarea',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_textarea; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_select',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_select; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_select2',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_select2; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_checkbox',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_checkbox; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'editable_date',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->editable_date; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'record_date',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->record_date; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'update_date',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->update_date; ?></p>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabelEx($model,'is_delete',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <p class="form-control-static"><?php echo $model->is_delete; ?></p>
    </div>
</div>
    
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::link(Yii::t('app', 'Update'), Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/update', ['id' => $model->editable_id]), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/admin'),  array('class' => 'btn btn-default')) ?>    </div>
</div>
    
</form>