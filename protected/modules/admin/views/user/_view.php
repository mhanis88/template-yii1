<?php
/* @var $this UserController */
/* @var $data User */
?>

<form class="form-horizontal">
    
<div class="form-group">
    <?php echo CHtml::activeLabel($model,'user_id',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <?php echo $model->user_id; ?>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabel($model,'user_username',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <?php echo $model->user_username; ?>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabel($model,'user_password',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <?php echo $model->user_password; ?>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabel($model,'email',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <?php echo $model->email; ?>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabel($model,'role_id',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <?php echo $model->role_id; ?>
    </div>
</div>
    
<div class="form-group">
    <?php echo CHtml::activeLabel($model,'reset_request',array('class'=>'col-sm-2')); ?>
    <div class="col-sm-10">
        <?php echo $model->reset_request; ?>
    </div>
</div>
    
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
	<?php if(GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "update")): ?>
        <?php echo CHtml::link(Yii::t('app', 'Update'), Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/update', ['id' => $model->user_id]), array('class' => 'btn btn-primary')); ?>
	<?php endif; ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/admin'),  array('class' => 'btn btn-default')) ?>    </div>
</div>
    
</form>