<?php
/* @var $this SysMenuController */
/* @var $model SysMenu */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
)); ?>

<div class="form-group">
    <?php echo $form->label($model, 'menu_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'menu_name', array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'parent_menu_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropdownList($model, 'parent_menu_id', SysMenu::model()->getDropDownList(), array('empty' => Yii::t('app', '-- All --'), 'class' => 'form-control select2', 'encode' => false)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'seq', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'seq', array('class' => 'form-control')); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->label($model, 'is_publish', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropdownList($model, 'is_publish', GeneralFunction::setYesNoLabel(), array('empty' => Yii::t('app', '-- All --'), 'class' => 'form-control select2')); ?>
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