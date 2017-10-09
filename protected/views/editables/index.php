<?php
/* @var $this EditablesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Editables',
);

$this->menu=array(
	array('label'=>'Create Editables', 'url'=>array('create')),
	array('label'=>'Manage Editables', 'url'=>array('admin')),
);
?>

<h1>Editables</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
