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
        'value' => '$data->user_id',
        'visible' => isset($pdf) ? false : true,
    ],
    [
        'header' => '#',
        'value' => '$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1', //  row is zero based
        'visible' => true,
    ],
    // 'user_id',
    'user_username',
    // 'user_password',
    'email',
    [
        'name' => 'role_id',
        'value' => 'isset($data->role) ? $data->role->role_name : ""',
    ],
    // 'role_id',
    'reset_request',
];

if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "create") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "view") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "update") ||
        GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, "deleteBulk")):

    $header = '';
    if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'create')):
        $header .= CHtml::link('<span class="glyphicon glyphicon-plus"></span>', Yii::app()->createUrl('admin/user/create'), array('class' => 'btn btn-info btn-sm', 'id' => 'add-record', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Add')));
    endif;

    if (GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'deleteBulk')):
        if (!empty($header)):
            $header .= ' ';
        endif;

        $text = '<span class="glyphicon glyphicon-trash"></span>';
        $url = Yii::app()->createUrl(Yii::app()->controller->module->id . '/' . Yii::app()->controller->id . '/deleteBulk');
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
                    $.fn.yiiGridView.update('user-grid');
                    $.fn.ajaxBusy('stop', '');
                }"
        ];
        $htmlOptions = ['class' => 'btn btn-sm btn-danger cls-delBulk', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => Yii::t('app', 'Delete')];
        $header .= CHtml::ajaxLink($text, $url, $ajaxOptions, $htmlOptions);
    endif;

    if (!isset($pdf)):
        $columns[] = [
            'header' => "<nobr>$header</nobr>",
            'class' => 'CButtonColumn',
            'template' => '{my_view}{my_edit}',
            'buttons' => [
                'my_view' => [
                    'label' => '<span class="glyphicon glyphicon-search"></span>&nbsp;',
                    'url' => 'Yii::app()->createUrl( Yii::app()->controller->module->id ."/". Yii::app()->controller->id ."/view", ["id" => $data->user_id ] )',
                    'options' => [ 'title' => Yii::t('app', 'View'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'],
                    'visible' => function($row, $data) {
                return GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'view');
            },
                ],
                'my_edit' => [
                    'label' => '<span class="glyphicon glyphicon-pencil"></span>&nbsp;',
                    'url' => 'Yii::app()->createUrl( Yii::app()->controller->module->id ."/". Yii::app()->controller->id ."/update", ["id" => $data->user_id ] )',
                    'options' => [ 'title' => Yii::t('app', 'Update'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'],
                    'visible' => function($row, $data) {
                return GeneralFunction::roleCheckerAction(Yii::app()->user->role, Yii::app()->controller, 'update');
            },
                ],
            ],
        ];
    endif;
endif;



$arr_grid = [
    'id' => 'user-grid',
    'itemsCssClass' => 'table table-striped table-hover table-admin',
    'afterAjaxUpdate' => "function(){ $('[data-toggle=tooltip]').tooltip(); makePageSizeSelect2(); }", // reload tooltip
    // 'filter'=>$model,
    'columns' => $columns,
];

if (isset($pdf)):
    $arr_grid['enablePagination'] = false;
    $arr_grid['enableSorting'] = false;

    $model->pdf = true;
    $model->totalItemCount = $model->search()->totalItemCount;
endif;

if ($model->search()->totalItemCount > min(Yii::app()->params['pageSizeOptions']) && !isset($pdf)):
    // if using normal bootstrap class just change to form-control & remove 'makePageSizeSelect2();' in 'afterAjaxUpdate' or else use select2
    $arr_grid['summaryText'] = '<span class="col-xs-5 col-sm-2 col-md-2 col-lg-1 text-left">'
            . CHtml::dropDownList('pageSize', $pageSize, Yii::app()->params['pageSizeOptions'], array('class' => 'select2', 'onchange' => '$.fn.yiiGridView.update(\'user-grid\',{ data:{ pageSize: $(this).val() }})'))
            . '</span><span class="col-xs-7 col-sm-4 col-md-2 col-lg-2 text-left">' . Yii::t('app', 'rows per page') . '</span>' . '<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">' . Yii::t('app', 'Displaying {start}-{end} of {count} result(s).') . '</div>';
endif;

$arr_grid['dataProvider'] = $model->search();
?>

<div class="table-responsive"><?php $this->widget('zii.widgets.grid.CGridView', $arr_grid); ?></div>

<?php $this->endWidget(); ?>


<script>
    function makePageSizeSelect2() {
        $('.select2').select2({theme: 'bootstrap'});
    }
</script>