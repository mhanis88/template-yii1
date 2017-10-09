<?php
/* @var $this SysRoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sys Roles',
);

$this->menu=array(
	array('label'=>'Create SysRole', 'url'=>array('create')),
	array('label'=>'Manage SysRole', 'url'=>array('admin')),
);
?>

<h1>Sys Roles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
