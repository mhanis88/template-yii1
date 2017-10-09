<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
?>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'editable_text', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $this->widget('editable.EditableField', array(
            'type' => 'text',
            'model' => $model,
            'attribute' => 'editable_text',
            'url' => $this->createUrl('site/updateUser'),
            'placement' => 'right',
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'editable_select', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $this->widget('editable.EditableField', array(
            'type' => 'select',
            'model' => $model,
            'attribute' => 'editable_select',
            'url' => $this->createUrl('site/updateUser'),
            'source' => Editable::source(SysModule::model()->findAll(), 'module_id', 'module_name'),
            'placement' => 'right',
        ));
        ?>
    </div>
</div>
<?php /*
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'editable_select2', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $this->widget('editable.EditableField', array(
            'type' => 'select2',
            'model' => $model,
            'attribute' => 'editable_select2',
            'url' => $this->createUrl('site/updateUser'),
            'source' => $tags,
            'placement' => 'right',
            'select2' => array(
                'multiple' => true
            )
        ));
        ?>
    </div>
</div>
*/ ?>
<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'editable_textarea', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $this->widget('editable.EditableField', array(
            'type' => 'textarea',
            'model' => $model,
            'attribute' => 'editable_textarea',
            'url' => $this->createUrl('site/updateUser'),
            'placement' => 'right',
                // 'showbuttons' => 'bottom',
        ));
        ?>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::activeLabel($model, 'editable_date', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $this->widget('editable.EditableField', array(
            'type' => 'date',
            'model' => $model,
            'attribute' => 'editable_date',
            'url' => $this->createUrl('site/updateUser'),
            'placement' => 'right',
            'showbuttons' => false,
        ));
        ?>
    </div>
</div>

<?php $this->endWidget(); ?>