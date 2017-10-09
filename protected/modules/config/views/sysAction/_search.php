<?php
/* @var $this SysActionController */
/* @var $model SysAction */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
)); ?>

<div class="form-group">
    <?php echo $form->label($model, 'module_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropDownList($model, 'module_id', SysModule::model()->getModuleList(), array('empty' => Yii::t('app', '-- All --'), 'class' => 'form-control select2', 'encode' => false)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'controller_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropDownList($model, 'controller_id', SysController::model()->getControllerList(), array('empty' => Yii::t('app', '-- All --'), 'class' => 'form-control select2', 'encode' => false)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'action_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'action_name', array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'action_desc', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'action_desc', array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Search'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::submitButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default', 'onclick' => 'js:$(".select2-selection__rendered").attr("title","'. Yii::t('app','-- All --') .'").text("'. Yii::t('app','-- All --') .'"); $(this).closest("form").trigger("reset");')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('select2', "
$('#SysAction_module_id').on('change', function(){
    $.ajax({
        type: 'POST',
        data: 'parent=' + $(this).val() + '&selected=". $model->controller_id ."&labelEmpty=". Yii::t('app', '-- All --') ."',
        url: '" . Yii::app()->createUrl('config/sysAction/loadController') . "',
        success: function(data){
            $('#SysAction_controller_id').select2('destroy');
            $('#SysAction_controller_id').html( data );
            $('#SysAction_controller_id').select2({ theme: 'bootstrap' });
        },
    });
});
", CClientScript::POS_READY);
?><!-- search-form -->