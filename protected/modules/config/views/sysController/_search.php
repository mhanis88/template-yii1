<?php
/* @var $this SysControllerController */
/* @var $model SysController */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
?>

<div class="form-group">
    <?php echo $form->label($model, 'controller_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'controller_name', array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'module_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropdownList($model, 'module_id', SysModule::model()->getModuleList(), array('empty' => Yii::t('app', '-- All --'), 'class' => 'form-control select2')); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Search'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::submitButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default', 'onclick' => 'js:$(".select2-selection__rendered").attr("title","' . Yii::t('app', '-- All --') . '").text("' . Yii::t('app', '-- All --') . '"); $(this).closest("form").trigger("reset");')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<!-- search-form -->