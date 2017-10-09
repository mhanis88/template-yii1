<?php
/* @var $this SysControllerController */
/* @var $model SysController */

$this->breadcrumbs=array(
	'Sys Controllers'=>array('index'),
	$model->controller_id,
);

$this->menu=array(
	array('label'=>'List SysController', 'url'=>array('index')),
	array('label'=>'Create SysController', 'url'=>array('create')),
	array('label'=>'Update SysController', 'url'=>array('update', 'id'=>$model->controller_id)),
	array('label'=>'Delete SysController', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->controller_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysController', 'url'=>array('admin')),
);
?>

<h1>View SysController #<?php echo $model->controller_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'controller_id',
		'controller_name',
		'record_by',
		'record_date',
		'update_by',
		'update_date',
	),
)); ?>
