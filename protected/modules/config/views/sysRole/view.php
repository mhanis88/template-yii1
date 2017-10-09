<?php
/* @var $this SysRoleController */
/* @var $model SysRole */

$this->breadcrumbs=array(
	'Sys Roles'=>array('index'),
	$model->role_id,
);

$this->menu=array(
	array('label'=>'List SysRole', 'url'=>array('index')),
	array('label'=>'Create SysRole', 'url'=>array('create')),
	array('label'=>'Update SysRole', 'url'=>array('update', 'id'=>$model->role_id)),
	array('label'=>'Delete SysRole', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->role_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysRole', 'url'=>array('admin')),
);
?>

<h1>View SysRole #<?php echo $model->role_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'role_id',
		'role_name',
		'record_by',
		'record_date',
		'update_by',
		'update_date',
		'is_delete',
	),
)); ?>
