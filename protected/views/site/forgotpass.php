<?php
/* @var $this SiteController */
/* @var $model ForgotForm */
/* @var $form CActiveForm */

/* osh on 04/11/2014 : Added new view file for forget password/username page */

$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Forgot Password');

$this->breadcrumbs = array(
    Yii::t('app', 'Forgot Password') => array('forgotPassword')
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Forgot Password '); ?></h3>
    </div>
    <div class="panel-body">
        <?php if (!isset($success)): ?>
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'forgot-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // See class documentation of CActiveForm for details on this,
            // you need to use the performAjaxValidation()-method described there.
            'enableAjaxValidation' => false,
            'htmlOptions' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
            )
        ));
        ?>
        <?php // echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-2')); ?>
            <div class="col-sm-4">
                <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'username'); ?>
            </div>

            <div class="col-sm-2">
                <?php echo CHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn btn-primary')); ?>
                <?php echo CHtml::button(Yii::t('app', 'Back'), array('class' => 'btn btn-default', 'submit' => array('index'))); ?>
            </div>
        </div>

        <?php $this->endWidget(); ?>
        <?php else: ?>        
            <div class="well well-lg"><?php echo Yii::t('app', 'Back to login page <a href="' . Yii::app()->createUrl('site/login') . '">here</a>.'); ?></div>      
        <?php endif; ?>
    </div>
</div>