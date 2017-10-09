<?php
/* @var $this EditablesController */
/* @var $model Editables */

$this->breadcrumbs=array(
        Yii::t('app', 'Administration'),
        Yii::t('app', 'Editables') => array('admin'),
        Yii::t('app', 'Update') => array('update', 'id' => $model->editable_id),
);
?>

<?php if(Yii::app()->params['form-template']=='fieldset'): ?>
    <fieldset>
        <legend><?php echo Yii::t('app', 'Update Editables') ?></legend>
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </fieldset>
<?php else: ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('app', 'Update Editables') ?></h3>
        </div>
        <div class="panel-body"><?php $this->renderPartial('_form', array('model'=>$model)); ?></div>
    </div>
<?php endif; ?>
