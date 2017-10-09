<?php
/* @var $this SysActionController */
/* @var $model SysAction */

$this->breadcrumbs = array(
    Yii::t('app', 'Configuration'),
    Yii::t('app', 'Action') => array('admin'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.ajaxbusy.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sys-action-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><?php echo Yii::t('app', 'Action') ?></h3>

<?php echo CHtml::linkButton('<span class="glyphicon glyphicon-search"></span> '. Yii::t('app', 'Search'), array('class' => 'btn btn-warning btn-sm search-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Search'))); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$form = $this->beginWidget('CActiveForm', [
    'id' => 'grid-form',
    'enableAjaxValidation' => true,
    'htmlOptions' => [
        'onsubmit' => "return false;",
    ],
]);

$columns = [
    [
        'header' => CHtml::checkbox('chk_all'),
        'class' => 'CCheckBoxColumn',
        'selectableRows' => 10,
        'checkBoxHtmlOptions' => [
            'name' => 'ids[]',
            'class' => 'chk-select',
        ],
        'value' => '$data->action_id',
    ],
    [
        'header' => SysModule::model()->getAttributeLabel('module_id'),
        'name' => 'module_id',
        'value' => 'isset($data->modules->module_name) ? $data->modules->module_name : ""',
    ],
    [
        'name' => 'controller_id',
        'value' => 'isset($data->controllers->controller_name) ? $data->controllers->controller_name : ""',
    ],
    'action_name',
    'action_desc',
    'record_by',
    'record_date',
    'update_by',
    'update_date',
];

if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "create") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "update") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "deleteBulk")):

    $header = '';
    if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'create')):
        $header .= CHtml::link('<span class="glyphicon glyphicon-plus"></span>', Yii::app()->createUrl('config/sysAction/create'), array('class' => 'btn btn-info btn-sm', 'id' => 'add-record', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Add')));
    endif;

    if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'deleteBulk')):
        if (!empty($header)):
            $header .= ' ';
        endif;

        $text = '<span class="glyphicon glyphicon-trash"></span>';
        $url = Yii::app()->createUrl('config/sysAction/deleteBulk');
        $ajaxOptions = [
            'type' => 'POST',
            'beforeSend' => "function( request ) {
                            $('#response').removeClass('alert-success');
                            $('#response').removeClass('alert-danger');
                            $.fn.ajaxBusy('start', '" . Yii::t('app', 'Processing...please wait') . "');
                }",
            'data' => 'js:$("#grid-form").serialize()',
            'dataType' => 'json',
            'success' => "function(data){
                    console.log(data);
                    $('#response').html(data.message);
                    $('#response').addClass(data.class);
                    $('#response').show();
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    setTimeout(function(){ $('#response').fadeOut(); }, 3000);
                    $.fn.yiiGridView.update('sys-action-grid');
                    $.fn.ajaxBusy('stop', '');
                }"
        ];
        $htmlOptions = ['class' => 'btn btn-sm btn-danger cls-delBulk', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Delete')];
        $header .= CHtml::ajaxLink($text, $url, $ajaxOptions, $htmlOptions);
    endif;

    $columns[] = [
        'header' => "<nobr>$header</nobr>",
        'class' => 'CButtonColumn',
        'template' => '{my_edit}',
        'buttons' => [
            'my_edit' => [
                'label' => '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="' . Yii::t('app', 'Update') . '"></span>&nbsp;',
                'url' => 'Yii::app()->createUrl( "config/sysAction/update", ["id" => $data->action_id ] )',
                'options' => [ 'title' => Yii::t('app', 'Update')],
                'visible' => function($row, $data) {
            return GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'update');
        },
            ],
        ],
    ];
endif;

$this->widget('zii.widgets.grid.CGridView', [
    'id' => 'sys-action-grid',
    'itemsCssClass' => 'table table-striped table-hover table-admin',
    'afterAjaxUpdate' => "function(){ $('[data-toggle=tooltip]').tooltip(); }", // reload tooltip
    'dataProvider' => $model->search(),
    // 'filter'=>$model,
    'columns' => $columns,    
]);

$this->endWidget();
?>
