<?php
/* @var $this EditablesController */
/* @var $model Editables */

$this->breadcrumbs=array(
        Yii::t('app', 'Administration'),
        Yii::t('app', 'Editables') => array('admin'),
        Yii::t('app', 'View') => array('view', 'id' => $model->editable_id),
);
?>

<?php if(Yii::app()->params['form-template']=='fieldset'): ?>
    <fieldset>
        <legend><?php echo Yii::t('app', 'View Editables') ?></legend>
        <?php $this->renderPartial('_view', array('model'=>$model)); ?>
    </fieldset>
<?php else: ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo Yii::t('app', 'View Editables') ?></h3>
        </div>
        <div class="panel-body"><?php $this->renderPartial('_view', array('model'=>$model)); ?></div>
    </div>
<?php endif; ?>
