<?php
/* @var $this EditablesController */
/* @var $model Editables */

$this->breadcrumbs = array(
    Yii::t('app', 'Administration'),
    Yii::t('app', 'Editables') => array('admin'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.ajaxbusy.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#editables-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3><?php echo Yii::t('app', 'Editables') ?></h3>

<?php echo CHtml::linkButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Search'), array('class' => 'btn btn-warning btn-sm search-button', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Search'))); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$tags = array(
    array('id' => 1, 'text' => 'php'),
    array('id' => 2, 'text' => 'html'),
    array('id' => 3, 'text' => 'css'),
    array('id' => 4, 'text' => 'javascript'),
);

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
        'value' => '$data->editable_id',
    ],
    [
        'class' => 'editable.EditableColumn',
        'name' => 'editable_text',
        'editable' => [
            'type' => 'text',
            'url' => $this->createUrl('editables/updateRecord'),
            'validate' => 'js: function(value) {
                            if($.trim(value) == "") return "' . Yii::t('app', 'Required') . '";
                        }',
            'placement' => 'right',
            'apply' => '$data->is_delete != 1',
        ],
    ],
    [
        'class' => 'editable.EditableColumn',
        'name' => 'editable_textarea',
        'editable' => [
            'type' => 'textarea',
            'url' => $this->createUrl('editables/updateRecord'),
            'apply' => '$data->is_delete != 1',
        ]
    ],
    [
        'class' => 'editable.EditableColumn',
        'name' => 'editable_select',
        'editable' => [
            'type' => 'select2',
            'url' => $this->createUrl('editables/updateRecord'),
            // 'source' => GeneralFunction::setEditableSource(SysRole::model()->findAllByAttributes(['is_delete' => 0]), 'role_name'),
            'source' => GeneralFunction::setEditableSource(SysModule::model()->findAll(), 'module_name'),
            // 'source' => $tags,
            'onShown' => "js: function() {
                        $('.select2-selection--single').attr('style', 'width: 200px;');
                    }",
            'apply' => '$data->is_delete != 1',
        ],
        'value' => array($this, 'gridSelect2'),
    ],
    [
        'class' => 'editable.EditableColumn',
        'name' => 'editable_select2',
        'editable' => [
            'type' => 'select2',
            'url' => $this->createUrl('editables/updateRecord'),
            'source' => GeneralFunction::setEditableSource(SysModule::model()->findAll(), 'module_name'),
            // 'source' => $tags,
            'select2' => array(
                'multiple' => true
            ),
            'onShown' => "js: function() {
                        $('.select2-search__field').attr('style', 'width: 200px;');
                    }",
            'onSave' => "js: function(e, params) {
                        $.fn.yiiGridView.update('editables-grid');
                    }",
            'apply' => '$data->is_delete != 1',
        ],
        'value' => array($this, 'gridSelect2Multi'),
    ],
    [
        'class' => 'editable.EditableColumn',
        'name' => 'editable_checkbox',
        'editable' => [
            'type' => 'checklist',
            'url' => $this->createUrl('editables/updateRecord'),
            'source' => GeneralFunction::setEditableSource(SysModule::model()->findAll(), 'module_name'),
            'showbuttons' => 'bottom',
            'apply' => '$data->is_delete != 1',
        ],
        'value' => array($this, 'gridCheckbox'),
    ],
    [
        'class' => 'editable.EditableColumn',
        'name' => 'editable_date',
        'editable' => [
            'type' => 'date',
            'url' => $this->createUrl('editables/updateRecord'),
            // 'format' => 'yyyy-mm-dd',
            'format' => 'dd-mm-yyyy',
            // 'viewformat' => 'dd-mm-yyyy',
            'showbuttons' => false,
            // to return message after success
            'success' => "js: function(data) {     
                // alert(data.message);
                            $('#response').html(data.message);
                            $('#response').addClass(data.class);
                            $('#response').show();
                            $('html, body').animate({ scrollTop: 0 }, 'slow');
                            setTimeout(function(){ $('#response').fadeOut(); }, 3000);
                            // $.fn.yiiGridView.update('editables-grid');
                        }",
            'options' => [
                'ajaxOptions' => ['dataType' => 'json'],
            ],
            'apply' => '$data->is_delete != 1',
        ]
    ],
    /*
      'record_date',
      'update_date',
     */
    [
        'class' => 'editable.EditableColumn',
        'name' => 'is_delete',
        'editable' => [
            'type' => 'select',
            'url' => $this->createUrl('editables/updateRecord'),
            'source' => GeneralFunction::setEditableSource(GeneralFunction::setYesNoLabel()),
            'success' => "js: function(data) { 
                            $.fn.yiiGridView.update('editables-grid');
                        }",
            'options' => [
                'ajaxOptions' => ['dataType' => 'json'],
            ],
        /*
          //custom display
          'options' => array(
          'display' => 'js: function(value, sourceData) {
          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
          colors = {1: "green", 0: "red"};
          $(this).text(selected[0].text).css("color", colors[value]);
          }'
          ),
         */
        ]
    ],
];

if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "create") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "view") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "update") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "deleteBulk")):

    $header = '';
    if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'create')):
        $header .= CHtml::link('<span class="glyphicon glyphicon-plus"></span>', Yii::app()->createUrl('editables/create'), array('class' => 'btn btn-info btn-sm', 'id' => 'add-record', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Add')));
    endif;

    if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'deleteBulk')):
        if (!empty($header)):
            $header .= ' ';
        endif;

        $text = '<span class="glyphicon glyphicon-trash"></span>';
        $url = Yii::app()->createUrl('editables/deleteBulk');
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
                    $.fn.yiiGridView.update('editables-grid');
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
        // 'template' => '{my_view}{my_edit}',
        'buttons' => [
            'my_view' => [
                'label' => '<span class="glyphicon glyphicon-search" data-toggle="tooltip" data-placement="top" title="' . Yii::t('app', 'View') . '"></span>&nbsp;',
                'url' => 'Yii::app()->createUrl( "editables/view", ["id" => $data->editable_id ] )',
                'options' => [ 'title' => Yii::t('app', 'View')],
                'visible' => function($row, $data) {
            return GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'view');
        },
            ],
            'my_edit' => [
                'label' => '<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="' . Yii::t('app', 'Update') . '"></span>&nbsp;',
                'url' => 'Yii::app()->createUrl( "editables/update", ["id" => $data->editable_id ] )',
                'options' => [ 'title' => Yii::t('app', 'Update')],
                'visible' => function($row, $data) {
            return GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'update');
        },
            ],
        ],
    ];
endif;

$this->widget('zii.widgets.grid.CGridView', [
    'id' => 'editables-grid',
    'itemsCssClass' => 'table table-striped table-hover table-admin',
    'afterAjaxUpdate' => "function(){ $('[data-toggle=tooltip]').tooltip(); }", // reload tooltip
    'dataProvider' => $model->search(),
    // 'filter'=>$model,
    'columns' => $columns,
]);

$this->endWidget();
?>