<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to CKEditor Sample</h1>

<p>Here is a sample of CKEditor Widget (Yii Plugin) basic + Plugin: Text color, Text Background, remove formatting.</p>

<?php
$this->widget('ext.ckeditor.CKEditorWidget', array(
	'model' => $model,
	'attribute' => 'email',
	// editor options http://docs.ckeditor.com/#!/api/CKEDITOR.config
	'config' => array(
		'language' => 'en',
	),
));
?>
<br>
<p>Kindly open the ckeditor.php file to view the code. TQ.</p>