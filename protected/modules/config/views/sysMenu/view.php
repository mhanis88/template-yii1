<?php
/* @var $this SysMenuController */
/* @var $model SysMenu */

$this->breadcrumbs=array(
	'Sys Menus'=>array('index'),
	$model->menu_id,
);

$this->menu=array(
	array('label'=>'List SysMenu', 'url'=>array('index')),
	array('label'=>'Create SysMenu', 'url'=>array('create')),
	array('label'=>'Update SysMenu', 'url'=>array('update', 'id'=>$model->menu_id)),
	array('label'=>'Delete SysMenu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->menu_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SysMenu', 'url'=>array('admin')),
);
?>

<h1>View SysMenu #<?php echo $model->menu_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'menu_id',
		'menu_name',
		'parent_menu_id',
		'seq',
		'record_by',
		'record_date',
		'update_by',
		'update_date',
		'is_delete',
	),
)); ?>
