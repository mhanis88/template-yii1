<?php
/* @var $this SysControllerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sys Controllers',
);

$this->menu=array(
	array('label'=>'Create SysController', 'url'=>array('create')),
	array('label'=>'Manage SysController', 'url'=>array('admin')),
);
?>

<h1>Sys Controllers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
