<?php
/* @var $this UserController */
/* @var $model User */

$label = Yii::t('app','User');
$this->breadcrumbs=array(
    Yii::t('app','Administration'),
    $label => array('admin'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.ajaxbusy.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
$('.btn-pdf').on('click', function(){
    $(this).button('loading');
    $.ajax({
        type: 'POST',
        data: $('.search-form form').serialize(),
        url: '" . Yii::app()->createUrl(Yii::app()->controller->module->id .'/'. Yii::app()->controller->id .'/gridViewPDF') . "',
        success: function(result){
            $('iframe[name=gridViewPDF]').attr({
                src: result,
                onload: $('.btn-pdf').button('reset'),
            });
        }
    });
    return false;
});
");
?>

<h3><?php echo $label ?></h3>

<?php echo CHtml::linkButton('<span class="glyphicon glyphicon-search"></span> '. Yii::t('app', 'Search'), array('class' => 'btn btn-warning btn-sm search-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Search'))); ?>
<?php if (Yii::app()->params['listTemplate'] != 'panel'):
    echo '&nbsp;' . CHtml::linkButton('<span class="glyphicon glyphicon-save-file"></span> PDF', ['class' => 'btn btn-primary btn-sm btn-pdf']);
endif;
?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php if(Yii::app()->params['listTemplate'] == 'panel'): ?>
<div class="panel panel-default">
	<!-- Default panel contents -->
	
	<?php echo CHtml::linkButton('<span class="glyphicon glyphicon-save-file"></span> PDF', ['class' => 'pull-right btn btn-primary btn-pdf']); ?>
	<div class="panel-heading"><?php echo Yii::t('app', 'List of Users') ?></div>
	<div class="panel-body">
		<?php  endif; ?>

		<?php  $this->renderPartial('_gridView', ['model' => $model, 'pageSize' => $pageSize]); ?>

		<?php if(Yii::app()->params['listTemplate'] == 'panel'): ?>  
	</div>
</div>
<?php endif; ?>

<iframe name="gridViewPDF" class="hide"></iframe>