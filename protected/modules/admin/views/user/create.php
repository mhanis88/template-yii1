<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
        Yii::t('app', 'Administration'),
	Yii::t('app', 'User') => array('admin'),
        Yii::t('app', 'Add') => array('create'),
);
?>

<?php if(Yii::app()->params['form-template']=='fieldset'): ?>
    <fieldset>
        <legend><?php echo Yii::t('app', 'Add User') ?></legend>
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </fieldset>
<?php else: ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('app', 'Add User') ?></h3>
        </div>
        <div class="panel-body"><?php $this->renderPartial('_form', array('model'=>$model)); ?></div>
    </div>
<?php endif; ?>
