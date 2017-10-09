<?php
/* @var $this MyProfileController */
/* @var $model Staff */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'staff-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
        ));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>


<div class="form-group">
    <?php echo $form->labelEx($model,'new_password', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->passwordField($model,'new_password', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'new_password'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model,'repeat_password', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->passwordField($model,'repeat_password', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model,'repeat_password'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::resetButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerCss('mycss', "
    .media {
        /*box-shadow:0px 0px 4px -2px #000;*/
        margin: 20px 0;
        padding:30px;
    }
    .dp {
        border:5px solid #eee;
        transition: all 0.2s ease-in-out;
    }
    .dp:hover {
        border:2px solid #eee;
        transform:rotate(360deg);
        -ms-transform:rotate(360deg);  
        -webkit-transform:rotate(360deg);  
        /*-webkit-font-smoothing:antialiased;*/
    }
");
?>

<!-- form -->