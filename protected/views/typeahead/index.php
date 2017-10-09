<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/plugin/bootstrap3-typeahead/bootstrap3-typeahead.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('suggestion', "
$('.typeahead').typeahead({
    source : function(query, process) {
        jQuery.ajax({
            url : '". Yii::app()->createUrl('typeahead/getOption') ."',
            type : 'POST',
            data : {
                q : query
            },
            dataType : 'json',
            success : function(data) {
                process(data);
            }
        });
    },
    minLength : 1,
});
", CClientScript::POS_END);
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
        <?php echo $form->textField($model, 'type_name', array('class' => 'form-control typeahead', 'autocomplete' => 'off')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'type_name'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>