<?php
/* @var $this UnderMaintenanceController */


$this->breadcrumbs = array(
    Yii::t('app', 'Administration'),
    Yii::t('app', 'Under Maintenance') => array('index'),
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'under-maintenance-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    )
        ));
?>

<div class="panel panel-primary">
    <div class="panel-heading"><?php echo Yii::t('app', 'Under Maintenance'); ?></div>
    <div class="panel-body">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'system', array('class' => 'col-sm-3')); ?>
            <div class="col-sm-9">
                <?php // echo $form->radiobuttonList($model, 'system', array(0 => Yii::t('app', 'Online'), 1 => Yii::t('app', 'Under Maintenance'))); ?>
                <?php echo $form->checkBox($model, 'system', array('class' => 'make-switch-maintenance')); ?>
                <?php echo $form->error($model, 'system'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <?php
                echo CHtml::submitButton(Yii::t('app', 'Submit'), array(
                    'confirm' => Yii::t('app', 'This action will affect all system users\n Please confirm your action'),
                    'class' => 'btn btn-primary'
                ));
                ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('make-switch', "
$('.make-switch-maintenance').bootstrapSwitch({
    'onText': '" . Yii::t('app', 'Under Maintenance') . "',
    'offText': '" . Yii::t('app', 'Online') . "',
    'onColor': 'success',
    'offColor': 'warning',
    'handleWidth': 130,
});
");
?>
