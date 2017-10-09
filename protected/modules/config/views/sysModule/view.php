<?php
/* @var $this SysModuleController */
/* @var $model SysModule */

$this->breadcrumbs=array(
	'Sys Modules'=>array('index'),
	$model->module_id,
);

$this->menu=array(
	array('label'=>'List SysModule', 'url'=>array('index')),
	array('label'=>'Create SysModule', 'url'=>array('create')),
	array('label'=>'Update SysModule', 'url'=>array('update', 'id'=>$model->module_id)),
	array('label'=>'Delete SysModule', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->module_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysModule', 'url'=>array('admin')),
);
?>

<h1>View SysModule #<?php echo $model->module_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'module_id',
		'module_name',
		'record_by',
		'record_date',
		'update_by',
		'update_date',
	),
)); ?>
