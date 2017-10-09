<?php
/* @var $this SysActionController */
/* @var $model SysAction */

$this->breadcrumbs=array(
	'Sys Actions'=>array('index'),
	$model->action_id,
);

$this->menu=array(
	array('label'=>'List SysAction', 'url'=>array('index')),
	array('label'=>'Create SysAction', 'url'=>array('create')),
	array('label'=>'Update SysAction', 'url'=>array('update', 'id'=>$model->action_id)),
	array('label'=>'Delete SysAction', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->action_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysAction', 'url'=>array('admin')),
);
?>

<h1>View SysAction #<?php echo $model->action_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'action_id',
		'action_name',
		'record_by',
		'record_date',
		'update_by',
		'update_date',
	),
)); ?>
