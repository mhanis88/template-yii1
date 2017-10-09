<?php
/* @var $this SysControllerController */
/* @var $data SysController */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('controller_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->controller_id), array('view', 'id'=>$data->controller_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('controller_name')); ?>:</b>
	<?php echo CHtml::encode($data->controller_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('record_by')); ?>:</b>
	<?php echo CHtml::encode($data->record_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('record_date')); ?>:</b>
	<?php echo CHtml::encode($data->record_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_by')); ?>:</b>
	<?php echo CHtml::encode($data->update_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('update_date')); ?>:</b>
	<?php echo CHtml::encode($data->update_date); ?>
	<br />


</div>