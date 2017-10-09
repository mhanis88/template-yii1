<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <?php
        /*
          <!-- blueprint CSS framework -->
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
          <!--[if lt IE 8]>
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
          <![endif]-->

          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
          <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
         */
        ?>
        <?php
        $baseUrl = Yii::app()->baseUrl;
        $baseThemeUrl = Yii::app()->theme->baseUrl;
        Yii::app()->getClientScript()->registerCoreScript('jquery');

        Yii::app()->clientScript->registerScript(
                'my vars', "var imagePath = 'http://" . $_SERVER['HTTP_HOST'] . $baseUrl . "/images/';", CClientScript::POS_HEAD);
        ?>

        <link rel="stylesheet" type="text/css" href="<?php echo $baseThemeUrl ?>/<?php echo SysThemes::getCurrentThemesByParentName() ?>/<?php echo SysThemes::getCurrentThemesByName() ?>/css/bootstrap.css" />
        <!-- // twitter default theme
        <link rel="stylesheet" type="text/css" href="<?php echo $baseThemeUrl ?>/twitter/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseThemeUrl ?>/twitter/css/bootstrap-theme.min.css" />
        -->
        <link type="text/css" rel="stylesheet" href="<?php echo $baseThemeUrl ?>/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $baseThemeUrl ?>/css/custom.css" />

        <link type="text/css" rel="stylesheet" href="<?php echo $baseUrl ?>/css/font-awesome-4.6.3/css/font-awesome.min.css" />

        <link type="text/css" rel="stylesheet" href="<?php echo $baseThemeUrl ?>/plugin/datepicker/css/datepicker3.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $baseThemeUrl ?>/plugin/switch/css/bootstrap3/bootstrap-switch.min.css" />

        <link type="text/css" rel="stylesheet" href="<?php echo $baseThemeUrl ?>/plugin/select2-4.0.0/css/select2.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo $baseThemeUrl ?>/plugin/select2-4.0.0/css/select2-bootstrap.css" />

        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/moment.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/twitter/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/switch/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/jquery.formatCurrency.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/jquery.alphanumeric.js"></script>

        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/select2-4.0.0/js/select2.full.js"></script>

        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/jquery.autogrowtextarea.js"></script>
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/bootstrap-filestyle-1.2.1/src/bootstrap-filestyle.min.js"></script>
        
        <script type="text/javascript" src="<?php echo $baseUrl ?>/js/eModal.js"></script>
        
        <script type="text/javascript" src="<?php echo $baseThemeUrl ?>/plugin/bootstrap3-typeahead/bootstrap3-typeahead.min.js"></script>
        <?php /*
          <link href="<?php echo $baseThemeUrl ?>/plugin/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
          <script src="<?php echo $baseThemeUrl ?>/plugin/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
         */ ?>

        <!--[if lt IE 9]>
            <script src="<?php echo $baseUrl ?>/js/html5shiv.js"></script>
            <script src="<?php echo $baseUrl ?>/js/respond.js"></script>
        <![endif]-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="<?php echo $baseUrl ?>/css/font-awesome-4.6.3/css/font-awesome.css" rel="stylesheet">
        <style>
            /* Fix alignment issue of label on extra small devices in Bootstrap 3.2 */
            .form-horizontal .control-label{
                padding-top: 7px;
            }

            header {
                /* height:100px; */
                height:70px;
                background-color: rgba(238, 238, 238, 0.3); /* equivalent to #eee */
                /* background-color:#eee; */
                /* background-color: transparent; */
            }

            @media all and (max-width: 1200px) {
                header {
                    height:55px;
                }
            }

            @media all and (max-width: 1100px) {
                header {
                    height:50px;
                }
            }

            @media all and (max-width: 999px) {
                header {
                    height:45px;
                }
            }

            @media all and (max-width: 899px) {
                header {
                    height:45px;
                }
            }

            @media all and (max-width: 799px) {
                header {
                    height:40px;
                }
            }

            @media all and (max-width: 699px) {
                header {
                    height:35px;
                }
            }

            @media all and (max-width: 599px) {
                header {
                    height:30px;
                }
            }

            @media all and (max-width: 499px) {
                header {
                    height:25px;
                }
            }

            @media all and (max-width: 399px) {
                header {
                    height:18px;
                }
            }

            #nav.affix {
                position: fixed;
                top: 0;
                width: 100%;
                z-index:10;
            }

            .editableform .form-group {
                margin-left: 0px;
                margin-right: 0px;
            }
            .editable-date .datepicker{
                font-size: 90%;
            }            
            .select2-dropdown {
                z-index: 9999;
            }

            /*
         * for sidebar Document (Guidelines & Manual)
         */
            nav.sidebar-menu-collapsed {
                width: 40px;
            }

            nav.sidebar-menu-expanded {
                width: 106px;
            }

            nav.sidebar {
                position: fixed;
                top: 55%;
                right: 0px;
                height: auto;
                background: none repeat scroll 0 0 lightgrey;
                color: white;
                padding: 10px 10px;
            }

            nav.sidebar a#justify-icon {
                outline: 0;
                color: white;
                font-size: 24px;
                font-style: normal;
            }

            nav.sidebar a#logout-icon {
                outline: 0;
                color: white;
                font-size: 24px;
                font-style: normal;
                position: absolute;
                bottom: 10px;
                left: 10px;
            }

            nav.sidebar ul {
                margin: 0;
                padding: 0;
                /* margin-top: 150px; */
            }

            nav.sidebar ul li {
                margin: 0;
                padding: 0;
                /* margin-top: 20px; */
                list-style-type: none;
            }

            nav.sidebar ul li a.expandable {
                outline: 0;
                color: grey;
                text-decoration: none;
                font-size: 20px;
            }

            nav.sidebar ul li a.expandable:hover {
                color: #bbbbbb;
            }

            nav.sidebar ul li a.expandable span.expanded-element {
                margin-left: 2px;
                display: none;
                font-size: 11px;
                position: relative;
                bottom: 2px;
            }

            nav.sidebar ul li.active {
                background: none repeat scroll 0 0 black;
                border-radius: 4px;
                text-align: center;
                margin-left: -4px;
                padding: 4px;
            }

            nav.sidebar ul li.active a.expandable {
                color: white !important;
            }

            nav.sidebar ul li.active a.expandable:hover {
                color: white !important;
            }
        </style>
    </head>
    <body>
        <?php
        Yii::app()->clientScript->registerScript('affix_nav', "
                $('#nav').affix({
                    offset: {
                      top: $('header').height()
                    }
                }); 
            ", CClientScript::POS_END);
        ?>
        <!-- osh on 14/10/2014 : Change image size & use img-responsive class -->
        <div class="container">
            <header class="masthead">
                <a href="<?php echo Yii::app()->createUrl('site'); ?>" alt="Logo">
                    <img src="<?php echo $baseUrl ?>/images/logo.png" class="img-responsive">
                </a>
            </header>
        </div>

        <?php // if (!Yii::app()->user->isGuest) { ?>
        <div id="nav" class="container">
            <div class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <!-- small screen nav toggle -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- nav links -->
                    <div class="navbar-collapse collapse" id="navbar">
                        <?php $this->renderPartial('//layouts/_nav1'); ?>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
            </div>
        </div>

        <?php if (isset($this->breadcrumbs) && !empty($this->breadcrumbs)): ?>
            <div class="container">

                <div class="breadcrumb">
                    <?php
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                        'links' => $this->breadcrumbs,
                    ));
                    ?>
                </div>

            </div>
        <?php endif ?>           

        <!-- global flash message for all -->
        <div class="container">
            <?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="alert alert-success" id="alert-flash-message">
                    <?php echo Yii::app()->user->getFlash('success'); ?>
                </div>
            <?php elseif (Yii::app()->user->hasFlash('error')): ?>
                <div class="alert alert-danger" id="alert-flash-message">
                    <?php echo Yii::app()->user->getFlash('error'); ?>
                </div>
            <?php endif; ?>
            <?php
            /*
             * 20150508 saiful: hide alert flash message if any in 5sec
             */
            Yii::app()->clientScript->registerScript(
                    'hide-alert-flash-message', '$("#alert-flash-message").animate({opacity: 1.0}, 5000).fadeOut("slow");', CClientScript::POS_READY
            );
            ?>
            <div id="response" class="alert" style="display: none"></div>
        </div>

        <noscript>
        <div class="container">
            <div class="col-lg-12">
                <div class="well">
                    <span class="attention-text">
                        <?php echo Yii::t('app', 'This site require JavaScript! Please enable it on your browser to continue.'); ?>
                        <a href="" target="_blank"><?php echo Yii::t('app', 'Instruction on how to enable JavaScript on browser'); ?></a>
                    </span>
                </div>
            </div>
        </div>
        </noscript>

        <nav class='sidebar sidebar-menu-collapsed hidden-xs hidden-sm hidden-phone hidden-tablet'>
            <ul>
                <li>
                    <a tabindex="0" class="expandable" id="popoverGuideline">
                        <span class="fa-stack collapsed-element" data-toggle="tooltip" data-placement="top" title="<?php echo Yii::t('app', 'Themes') ?>" data-content="Test themes"><span class="glyphicon glyphicon-list-alt"></span><!--<i class="fa fa-bookmark"></i>-->
                            <span class="expanded-element"><?php echo Yii::t('app', 'Themes') ?></span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="container" id="bs-content" ng-app="apps"><?php echo $content; ?></div>

        <div class="footer">
            <div class="container">           
                <div class="bs-footer">
                    <p class="text-muted">
                        <small>
                            Infotree Sdn Bhd,<br />
                            Unipark Suria, Jalan Ikram-Uniten,<br />
                            43000 Kajang, Selangor Darul Ehsan.<br />
                            <span class="glyphicon glyphicon-phone-alt"></span>&nbsp;&nbsp;603-87383333&nbsp;
                            <span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;603-87369932<br />
                        </small>
                    </p>
                </div>
            </div>
        </div>   

        <?php
        /*
         * saiful on 18/12/2015 : 9.24am
         * need to define here rather than use Yii::app()->clientScript->registerScript otherwise custom declaration will be above from these 
         */
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                // $.fn.editable.defaults.mode = 'popup'; // inline or popup
                $.fn.select2.defaults.set('width', 'style');
                $('.select2').select2({theme: 'bootstrap'});
            });
        </script>

    </body>
</html>    

<div id="popoverGuidelineContent" style="display: none"></div>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'themes-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form'),
    ));
    ?>

    <div class="form-group">
        <div class="col-sm-8">
            <?php echo CHtml::radioButtonList('all_themes', SysThemes::getCurrentThemesByID(), SysThemes::getOptionList(), array('class'=>'picked', 'labelOptions'=>array('style'=>'color:grey'))); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<?php
Yii::app()->clientScript->registerScript('main-add-error-class', "           
$('.errorSummary').addClass('alert alert-danger');
$('.errorMessage').addClass('alert alert-danger');
$('.errorMessage').attr('style','padding-bottom: 5px; padding-top: 5px;');
$('span.required').css('color', 'red');  
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('main-datepicker', "                  
$('.input-group.date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true
});
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('main-datepicker-year', "
$('.dtPickerYear').datepicker( {
    format: 'yyyy',
    viewMode: 'years', 
    minViewMode: 'years',
    autoclose: true,
});
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('main-datetimepicker', "
$('.timepicker').datetimepicker({
    format: 'LT'
});
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript(
        'toggle-popover-modal', "
$('#popoverGuideline').popover({
    html : true, 
    content: function() {
        return $('#popoverGuidelineContent').html();
    },
    title: '<span style=\"color:black\">" . Yii::t('app', 'Themes') . "</span>',
    placement: 'left',
    template: '<div class=\"popover\" style=\"width: 200px; z-index: 100;\"><div class=\"arrow\"></div><div class=\"popover-inner\"><h3 class=\"popover-title\"></h3><div class=\"popover-content\"><p></p></div></div></div>'
});

$('body').on('click', '.picked', function() {
    var id = $(this).val();
    $.ajax({
        type: 'POST',
            dataType: 'json',
            data : 'id=' + id,
            url: '" . Yii::app()->createUrl('site/processThemes') . "',
            success : function(data){
                if(data.result == true) {
                    location.reload();
                }
            }
    });
});
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('main-toggle-tooltip', "
$('[data-toggle=tooltip]').tooltip();
$('body').tooltip({ selector: '[data-toggle=tooltip]'} );
", CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('main-delete-listing', "
$('form').on('click', '.cls-delBulk', function(){
    var atLeastOneIsChecked = $('.chk-select:checked').length > 0;

    if (!atLeastOneIsChecked) {
        alert('" . Yii::t('app', 'Please select at least one record to delete') . "');
        return false;
    }
    else { 
        var r = confirm('" . Yii::t('app', 'Are you sure you want to delete these record(s)?') . "');
        if(r == true )
            return true;
        else return false;
    }
});
");

Yii::app()->clientScript->registerScript('main-make-swicth', "
$('.make-switch-status').bootstrapSwitch({
    'onText': '" . GeneralFunction::getStatusLabel(1) . "',
    'offText': '" . GeneralFunction::getStatusLabel(0) . "',
    'onColor': 'success',
    'offColor': 'warning',
});
$('.make-switch-yesno').bootstrapSwitch({
    'onText': '" . GeneralFunction::getYesNoLabel(1) . "',
    'offText': '" . GeneralFunction::getYesNoLabel(0) . "',
    'onColor': 'success',
    'offColor': 'warning',
});
");

Yii::app()->clientScript->registerScript('main-integer-decimal-currency', "
$('.input-integer').numeric();
$('.input-decimal').numeric({ 'allow': '.'});
$('.input-currency').on('blur',function(){
    $(this).formatCurrency({ symbol: '' });
}).numeric({ 'allow': '.'});;
");

Yii::app()->clientScript->registerScript('main-date-picker-range', "
// datepicker range config
var planStartDate = new Date();
var planEndDate = new Date();

$('.cls-start-date').datepicker('remove').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true,
    // startDate: '+0d'
}).on('changeDate',function(selected) {
    planStartDate = new Date(selected.date.valueOf());
    planStartDate.setDate(planStartDate.getDate(new Date(selected.date.valueOf())));
    $('.cls-end-date').datepicker('setStartDate', planStartDate);
}).on('clearDate', function (selected) {
    $('.cls-end-date').datepicker('setStartDate', null);
});

$('.cls-end-date').datepicker('remove').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    todayHighlight: true,
}).on('changeDate', function(selected){
    planEndDate = new Date(selected.date.valueOf());
    planEndDate.setDate(planEndDate.getDate(new Date(selected.date.valueOf())));
    $('.cls-start-date').datepicker('setEndDate', planEndDate);
}).on('clearDate', function (selected) {
    $('.cls-start-date').datepicker('setEndDate', null);
});
");

Yii::app()->clientScript->registerScript('main-auto-grow', "
$('.cls-autogrow').autoGrow();
");
?>