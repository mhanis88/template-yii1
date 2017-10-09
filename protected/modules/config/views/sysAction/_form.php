<?php
/* @var $this SysActionController */
/* @var $model SysAction */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'sys-action-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
// var_dump($modelList);
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<?php
$htmlOpt = ['empty' => Yii::t('app', '-- Select --'), 'class' => 'form-control select2'];
?>
<div class="form-group">
    <?php echo $form->labelEx($model, 'module_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $str = $form->dropDownList($model, 'module_id', SysModule::model()->getModuleList(), $htmlOpt);
        
        if ($model->isNewRecord):
            echo $str;
        else:
            echo '<span class="hide">'. $str . '</span>';
            echo $model->modules->module_name;
        endif;
        ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'module_id'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'controller_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php
        $str = $form->dropDownList($model, 'controller_id', [], $htmlOpt);
        
        if ($model->isNewRecord):
            echo $str;
        else:
            echo '<span class="hide">'. $str . '</span>';
            echo $model->controllers->controller_name;
        endif;
        ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'controller_id'); ?>
    </div>
</div>
<?php /*
  <div class="form-group">
  <?php echo $form->labelEx($model, 'action_name', array('class' => 'col-sm-2')); ?>
  <div class="col-sm-4">
  <?php echo $form->textField($model, 'action_name', array('class' => 'form-control')); ?>
  </div>
  <div class="col-sm-4">
  <?php echo $form->error($model, 'action_name'); ?>
  </div>
  </div>

  <div class="form-group">
  <?php echo $form->labelEx($model, 'action_desc', array('class' => 'col-sm-2')); ?>
  <div class="col-sm-4">
  <?php echo $form->textArea($model, 'action_desc', array('class' => 'form-control')); ?>
  </div>
  <div class="col-sm-4">
  <?php echo $form->error($model, 'action_desc'); ?>
  </div>
  </div>
 */ ?>
<div class="form-group">
    <?php echo $form->labelEx($model, 'action_id', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-8">
        <div class="table-responsive">
            <table class="table table-condensed" id="tbl-action">
                <thead>
                    <tr>
                        <th><?php echo CHtml::checkBox('checkAll', false, ['class' => 'form-control cls-check-all']) ?></th>
                        <th><?php echo $form->labelEx($model, 'action_name'); ?></th>
                        <th><?php echo $form->labelEx($model, 'action_desc'); ?></th>
                        <th><?php echo CHtml::linkButton('<span class="glyphicon glyphicon-plus"></span>', ['class' => 'cls-add btn btn-sm btn-info']) ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modelList as $list): ?>
                        <tr class="<?php echo ($list->action_id == $model->action_id) ? 'active' : '' ?>">
                            <td class="text-center"><?php echo CHtml::checkBox('action_id[]', !empty($list->action_name) ? true : false, ['value' => $list->action_id, 'class' => 'cls-id']) ?></td>
                            <td><?php echo CHtml::textField('action_name[]', $list->action_name, ['class' => 'form-control cls-name']) ?></td>
                            <td><?php echo CHtml::textArea('action_desc[]', $list->action_desc, ['class' => 'form-control cls-autogrow']) ?></td>
                            <td><?php echo CHtml::linkButton('<span class="glyphicon glyphicon-trash"></span>', ['class' => 'cls-delete btn btn-sm btn-warning']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($modelList)): ?>
                        <tr>
                            <td class="text-center"><?php echo CHtml::checkBox('action_id[]', false, ['value' => '', 'class' => '']) ?></td>
                            <td><?php echo CHtml::textField('action_name[]', '', ['class' => 'form-control cls-name']) ?></td>
                            <td><?php echo CHtml::textArea('action_desc[]', '', ['class' => 'form-control cls-autogrow']) ?></td>
                            <td><?php echo CHtml::linkButton('<span class="glyphicon glyphicon-trash"></span>', ['class' => 'cls-delete btn btn-sm btn-warning']) ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot class="hide">
                    <tr>
                        <td>&nbsp;</td>
                        <td><?php echo CHtml::tag('div', ['class' => 'errorMessage cls-name-error'], $model->getAttributeLabel('action_name') . ' ' . Yii::t('app', 'cannot be blank.')) ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('class' => 'btn btn-primary btn-submit')); ?>
        <?php echo CHtml::resetButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl(Yii::app()->controller->module->id . '/' . Yii::app()->controller->id . '/admin'), array('class' => 'btn btn-default')) ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('select2', "
$('#SysAction_module_id').on('change', function(){
    $.ajax({
        type: 'POST',
        data: 'parent=' + $(this).val() + '&selected=" . $model->controller_id . "',
        url: '" . Yii::app()->createUrl('config/sysAction/loadController') . "',
        success: function(data){
            $('#SysAction_controller_id').select2('destroy');
            $('#SysAction_controller_id').html( data );
            $('#SysAction_controller_id').select2({ theme: 'bootstrap' });
        },
    });
}).trigger('change');

$('#SysAction_controller_id').on('change', function(){
    $.ajax({
        type: 'POST',
        data: 'parent=' + $(this).val(),
        url: '" . Yii::app()->createUrl('config/sysAction/loadListAction') . "',
        success: function(data){
            if(data!=''){
                $('#tbl-action tbody').empty().append(data);
            }
        },
    });
}).trigger('change');
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('list-action', "
$('#tbl-action').on('click', '.cls-add', function(){
    $('#'+ $(this).closest('table').attr('id') +' tbody>tr:last').clone(true).insertAfter('#'+ $(this).closest('table').attr('id') +' tbody>tr:last');
    $('#'+ $(this).closest('table').attr('id') +' tbody>tr:last').find('input, textarea').val('');
    $('#'+ $(this).closest('table').attr('id') +' tbody>tr:last').find('input[type=checkbox]').prop('checked', false);
    return false;
});
$('#tbl-action').on('click', '.cls-delete', function(){
    var rowIndex = $(this).closest('tbody tr').index();
    var tableId = $(this).closest('table').attr('id');
    var recordId = $(this).closest('tr').find('.cls-id').val();
    
    var r = confirm('" . Yii::t('app', 'Are you sure you want to delete this Action?') . "');
    if(r==true){
        $.ajax({
            url: '" . Yii::app()->createUrl('config/sysAction/deleteAction') . "',
            type: 'POST',
            dataType: 'json',
            data: {
                tableId: tableId,
                rowIndex: rowIndex,
                recordId: recordId,
            },
            success: function(data){
                if($('#' + data.tableId +' tbody tr').length>1){
                    $('#'+ data.tableId +' tbody tr').eq(data.rowIndex).remove();
                } else {
                    $('#'+ data.tableId +' tbody tr').eq(data.rowIndex).find('input, textarea').val('');
                    $('#'+ data.tableId +' tbody tr').eq(data.rowIndex).find('input[type=checkbox]').prop('checked', false);
                }
            },
        });
    }
    return false;
});

$('#tbl-action').on('blur', '.cls-name', function(){
    checkActionName($(this));    
    return false;
});

$('.btn-submit').on('click', function(){
    checkActionName($('.cls-name'));
    return !$('.cls-name-error').is(':visible');
});

function checkActionName(obj){
    $('.cls-name-error').closest('tfoot').addClass('hide');
    var fieldEmpty = true;
    obj.each(function(){
        $(this).closest('tr').find('[name^=action_id]').prop('checked', false);
        if($(this).val()!=''){
            fieldEmpty = false;
            $(this).closest('tr').find('[name^=action_id]').prop('checked', true);
        }        
    });
    if(fieldEmpty){
        $('.cls-name-error').closest('tfoot').removeClass('hide');
    }
}
");
?>

<!-- form -->