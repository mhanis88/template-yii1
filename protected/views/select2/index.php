<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'type_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropdownList($model, 'type_name', TmpType::model()->getOptionList(), array('class' => 'select2multi', 'multiple' => 'multiple')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'type_name'); ?>
    </div>
</div>

<div class="input-group"><span class="input-group-addon">Level 1</span><?php echo CHtml::dropDownList('test', '', [], ['class' => 'select2'])?></div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('select2', "
$('.select2multi').select2({ 
    placeholder: '". Yii::t('app', '-- Either select 1 from the list or type anything --') ."',
    theme: 'bootstrap',
    tags: true,
    maximumSelectionLength: 1,
    maximumInputLength: 150,
});
", CClientScript::POS_READY);
?>