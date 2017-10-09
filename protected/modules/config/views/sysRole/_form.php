<?php
/* @var $this SysRoleController */
/* @var $model SysRole */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'sys-role-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
        ));
?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'role_name', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textField($model, 'role_name', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'role_name'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'role_desc', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->textArea($model, 'role_desc', array('class' => 'form-control')); ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'role_desc'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'role_access', array('class' => 'col-sm-2')); ?>
    <?php
    $modelModule = SysModule::model()->findAll();
    $i = 0;
    foreach ($modelModule as $module):
        $i++;
        ?>
        <div class="col-sm-8<?php echo $i > 1 ? ' col-sm-offset-2' : '' ?>">
            <div class="panel panel-success cls-panel-toggle">
                <div class="panel-heading"><span class="glyphicon glyphicon-chevron-down cls-icon-toggle" style="cursor: pointer;"></span> <?php echo CHtml::checkBox('Module[]', false, array('value' => $module->module_id, 'id' => 'id-module-' . $module->module_id, 'class' => 'cls-module')) ?> <?php echo CHtml::tag('label', array('for' => 'id-module-' . $module->module_id, 'class' => 'cls-module'), Yii::t('app', 'Module') . ': ' . $module->module_name) ?></div>
                <div class="panel-body">
                    <?php
                    $modelController = SysController::model()->findAll(array('condition' => 'module_id = :module', 'params' => array(':module' => $module->module_id), 'order' => 'controller_name'));
                    echo '
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="col-sm-3">' . Yii::t('app', 'Controller') . '</th>
                                <th class="col-sm-9">' . Yii::t('app', 'Action') . '</th>
                            </tr>
                            </thead>
                            <tbody>
                    ';
                    foreach ($modelController as $controller):
                        echo '
                            <tr>
                                <td class="success">' . CHtml::checkBox('Controller['. $module->module_id .'][]', false, array('value' => $controller->controller_id, 'id' => 'id-controller-' . $controller->controller_id, 'class' => 'cls-controller')) . ' ' . CHtml::tag('label', array('for' => 'id-controller-' . $controller->controller_id, 'class' => 'cls-controller'), $controller->controller_name) . '</td>
                                <td>';

                        $modelAction = SysAction::model()->findAll(array('condition' => 'controller_id = :controller', 'params' => array(':controller' => $controller->controller_id), 'order' => 'action_name'));
                        foreach ($modelAction as $action):
                            echo '<span class="col-sm-4"><nobr>'
                            . CHtml::checkBox('Action['. $module->module_id .']['. $controller->controller_id .'][]', in_array($action->action_id, $access['action']), array('value' => $action->action_id, 'id' => 'id-action-' . $action->action_id)) . ' '. CHtml::tag('label', array('for' => 'id-action-' . $action->action_id), $action->action_name)
                            . '</nobr></span>';
                        endforeach;

                        echo '</td>';
                    endforeach;
                    echo '
                            </tbody>
                        </table>
                    </div>
                    ';
                    ?>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model, 'role_menu', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4 checkbox">
        <?php echo GeneralFunction::printAccessMenu($menu,GeneralFunction::buildTreeMenu(SysMenu::model()->getAllMenuArray())); ?>      
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::resetButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/admin'),  array('class' => 'btn btn-default')) ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('select-module', "
$('.cls-module').on('click', function(){
    var checkedModule = $(this).closest('div').find('input[type=checkbox]').is(':checked');
    $(this).closest('div.panel').find('input[id^=id-controller-], input[id^=id-action-]').prop('checked',checkedModule);
});
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('select-controller', "
$('.cls-controller').on('click', function(){
    var checkedController = $(this).closest('td').find('input[type=checkbox]').is(':checked');
    $(this).closest('tr').find('input[id^=id-action-]').prop('checked',checkedController);
});
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('icon-toggle', "
$('.cls-icon-toggle').on('click', function(){
    if( $(this).hasClass('glyphicon-chevron-down') ) {
        $(this).removeClass('glyphicon-chevron-down');
        $(this).addClass('glyphicon-chevron-right');
    }    
    else {
        $(this).removeClass('glyphicon-chevron-right');
        $(this).addClass('glyphicon-chevron-down');
    }
    
    $(this).closest('div.panel').find('.panel-body').slideToggle();
});
", CClientScript::POS_READY);
?>
<!-- form -->