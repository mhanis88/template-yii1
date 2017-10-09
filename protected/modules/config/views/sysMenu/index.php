<?php
/* @var $this SysMenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sys Menus',
);

$this->menu=array(
	array('label'=>'Create SysMenu', 'url'=>array('create')),
	array('label'=>'Manage SysMenu', 'url'=>array('admin')),
);
?>

<h1>Sys Menus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
