<?php
/* @var $this SysMenuController */
/* @var $model SysMenu */
/* @var $form CActiveForm */
?>

<?php
// for spinner
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/plugin/touchspin/css/jquery.bootstrap-touchspin.min.css');
Yii::app()->clientScript->registerScriptFile(
        Yii::app()->theme->baseUrl . '/plugin/touchspin/js/jquery.bootstrap-touchspin.min.js', CClientScript::POS_END
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'sys-menu-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'menu_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'menu_name', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'menu_name'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'parent_menu_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->dropDownList($model, 'parent_menu_id', SysMenu::model()->getDropDownList(), array('empty' => Yii::t('app', '-- Select --'), 'class' => 'form-controls select2', 'encode' => false)); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'parent_menu_id'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'menu_url', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'menu_url', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'menu_url'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'seq', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-2">
        <?php echo $form->textField($model, 'seq', array('class' => 'form-control touchspin text-center')); ?>
    </div>
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo $form->error($model, 'seq'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'divider', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->checkBox($model, 'divider', array('class' => 'make-switch-yesno')) ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'is_publish', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->checkBox($model, 'is_publish', array('class' => 'make-switch-yesno')) ?>
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

<?php
Yii::app()->clientScript->registerScript('touchspin', "
$('.touchspin').TouchSpin({
    step: 1,
    max: 9999,
    // min:1,
    verticalbuttons: true,
    verticalupclass: 'glyphicon glyphicon-plus',
    verticaldownclass: 'glyphicon glyphicon-minus'
});
", CClientScript::POS_READY);
?>

<!-- form -->