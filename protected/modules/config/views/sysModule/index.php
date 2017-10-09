<?php
/* @var $this SysModuleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sys Modules',
);

$this->menu=array(
	array('label'=>'Create SysModule', 'url'=>array('create')),
	array('label'=>'Manage SysModule', 'url'=>array('admin')),
);
?>

<h1>Sys Modules</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
