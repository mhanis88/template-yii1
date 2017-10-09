<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('app', 'Change Password');

if ($model !== null):

    $this->breadcrumbs = array(
        Yii::t('app', 'Change Password') => array('changePassword', 'id' => $model->user_id, 't' => $model->reset_request)
    );
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('app', 'Change Password'); ?></h3>
        </div>
        <div class="panel-body">

            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'change-form',
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

            <?php echo $form->errorSummary($model); ?>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'staff_no', array('class' => 'col-sm-2')); ?>
                <div class="col-sm-4">
                    <?php echo isset($model->staff) ? $model->staff->staff_no : '-' ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'new_password', array('class' => 'col-sm-2')); ?>
                <div class="col-sm-4">
                    <?php echo $form->passwordField($model, 'new_password', array('class' => 'form-control')); ?>
                </div>
                <div class="col-sm-4">
                    <?php echo $form->error($model, 'new_password'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'repeat_password', array('class' => 'col-sm-2')); ?>
                <div class="col-sm-4">
                    <?php echo $form->passwordField($model, 'repeat_password', array('class' => 'form-control')); ?>
                </div>
                <div class="col-sm-4">
                    <?php echo $form->error($model, 'repeat_password'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-2">
                    <?php echo CHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn btn-primary')); ?>
                    <?php echo CHtml::button(Yii::t('app', 'Back'), array('class' => 'btn btn-default', 'submit' => array('index'))); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>

        </div>
    </div>
    <?php
else:

    $this->breadcrumbs = array(
        Yii::t('app', 'Change Password')
    );
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('app', 'Change Password'); ?></h3>
        </div>
        <div class="panel-body">
            <div class="well well-lg"><?php
                if (isset($success))
                    echo Yii::t('app', 'Password Changed successfully. Back to login page <a href="' . Yii::app()->createUrl('site/login') . '">here</a>.');
                else
                    echo Yii::t('app', 'Your link already expired. Please request to Reset Password again <a href="' . Yii::app()->createUrl('site/forgotPassword') . '">here</a> or back to login page <a href="' . Yii::app()->createUrl('site/login') . '">here</a>.');
                ?></div>                    
        </div>
    </div>
<?php
endif;
?>