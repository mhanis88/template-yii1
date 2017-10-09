<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
        Yii::t('app', 'Administration'),
        Yii::t('app', 'Users') => array('admin'),
        Yii::t('app', 'View') => array('view', 'id' => $model->user_id),
);
?>

<?php if(Yii::app()->params['form-template']=='fieldset'): ?>
    <fieldset>
        <legend><?php echo Yii::t('app', 'View Users') ?></legend>
        <?php $this->renderPartial('_view', array('model'=>$model)); ?>
    </fieldset>
<?php else: ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('app', 'View Users') ?></h3>
        </div>
        <div class="panel-body"><?php $this->renderPartial('_view', array('model'=>$model)); ?></div>
    </div>
<?php endif; ?>
