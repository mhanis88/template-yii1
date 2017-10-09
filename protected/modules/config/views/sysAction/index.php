<?php
/* @var $this SysActionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sys Actions',
);

$this->menu=array(
	array('label'=>'Create SysAction', 'url'=>array('create')),
	array('label'=>'Manage SysAction', 'url'=>array('admin')),
);
?>

<h1>Sys Actions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
