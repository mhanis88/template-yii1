<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('editable', dirname(__FILE__) . '/../extensions/x-editable');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Template',
    'theme' => 'bootstrap-3.3.4',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.yii-mail.*',
        'editable.*', //easy include of editable classes
        'ext.pdffactory.*',
        // 'application.pdf.docs.*', //the path where you place the EPdfFactoryDoc classes
        'application.helpers.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'adm1n',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'config',
        'admin',
    ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'WebUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'header' => '<div class="pagination">',
                    'footer' => '</div>',
                    'nextPageLabel' => Yii::t('app', 'Next'),
                    'prevPageLabel' => Yii::t('app', 'Prev'),
                    'lastPageLabel' => Yii::t('app', 'Last'),
                    'firstPageLabel' => Yii::t('app', 'First'),
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => array(
                        'class' => '',
                    )
                )
            )
        ),
        // uncomment the following to enable URLs in path-format
        /*
          'urlManager'=>array(
          'urlFormat'=>'path',
          'rules'=>array(
          '<controller:\w+>/<id:\d+>'=>'<controller>/view',
          '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
          '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
          ),
          ),
         */

        // database settings are configured in database.php
        // please use this (separate db file) for db connection
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            // 'errorAction' => 'site/error', // use this in development environment
            'errorAction' => YII_DEBUG ? null : array('site/error'), // use this in production environment
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, trace', // remove trace in production mode
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class' => 'CWebLogRoute',
              //fizi tambah
              'levels' => 'trace, info, error, warning',
              'categories' => 'system.db.*',
              ),
              ),
             */
            ),
        ),
        'mail' => array(
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp', // case sensitive!
            'transportOptions' => array(
            /*
              'host' => 'smtp.gmail.com',
              'username' => 'info3@ikram.com.my',
              'password' => 'Pswd@1234',
              'port' => '465',
              'encryption' => 'ssl',
             */
            ),
            'viewPath' => 'application.views.mail',
            'logging' => true,
            'dryRun' => false
        ),
        // /*
        'editable' => array(
            'class' => 'editable.EditableConfig',
            'form' => 'yii_bootstrap',
            'mode' => 'popup', // popup or inline  
            'defaults' => array(
                'emptytext' => 'Click to edit',
                //'ajaxOptions' => array('dataType' => 'json') //usefull for json exchange with server
            )
        ),
        // */
        'pdfFactory' => array(
            'class' => 'ext.pdffactory.EPdfFactory',
            //'tcpdfPath'=>'ext.pdffactory.vendors.tcpdf', //=default: the path to the tcpdf library
            //'fpdiPath'=>'ext.pdffactory.vendors.fpdi', //=default: the path to the fpdi library
            //the cache duration
            'cacheHours' => 5, //-1 = cache disabled, 0 = never expires, hours if >0
            //The alias path to the directory, where the pdf files should be created
            'pdfPath' => 'application.runtime.pdf',
            //The alias path to the *.pdf template files
            //'templatesPath'=>'application.pdf.templates', //= default
            //the params for the constructor of the TCPDF class  
            // see: http://www.tcpdf.org/doc/code/classTCPDF.html 
            'tcpdfOptions' => array(
            /* default values
              'format'=>'A4',
              'orientation'=>'P', //=Portrait or 'L' = landscape
              'unit'=>'mm', //measure unit: mm, cm, inch, or point
              'unicode'=>true,
              'encoding'=>'UTF-8',
              'diskcache'=>false,
              'pdfa'=>false,
             */
            )
        ),
        'ePdf' => array(
            'class' => 'ext.pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendor.mpdf57.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder.
                /*
                  'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
            ),
        ),
        'image'=>array(
          'class'=>'ext.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
        ),
    /*
      'booster' => array(
      'class' => 'ext.booster.components.Booster',
      ),
     */
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'bootstrap' => 'bootswatch', // bootswatch/prepbootstrap/visigene
        'bootstrapTheme' => 'readable', // put folder name in themes/../ here
        'sessionTimeoutSeconds' => -1, //timeout value in seconds 60s = 1m, 900s = 15m, -1 if do not want to apply session timeout
        'cookieName' => 'ess_maintbypass_template',
        'cookieValue' => 'ess1nf0tr33',
        'form-template' => 'fieldset', // value: panel or fieldset - if using custom crud infotree-admin
        'defaultPageSize' => 10, // default pageSize for gridView
        'pageSizeOptions' => array(10 => 10, 20 => 20, 50 => 50, 100 => 100),
        'fileUploadDir' => 'upload',
        'listTemplate' => 'panel', // value: panel or '' - if using custom crud infotree-admin
    ),
    /*
     * this is function for admin to change the site to Under Maintenance mode
     * for development purpose it advisable to change cookie name because it probably will affect other systems too which using the maintenance mode at the same root folder
     * any changes to cookie name and value please make sure you change at both catchAllRequest below and params above (or else you need to open file modules/admin/controllers/UnderMaintenanceController)
     * originally: ess_maintbypass
     */
    'catchAllRequest' => file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "runtime" . DIRECTORY_SEPARATOR . ".maintenance") && !(isset($_COOKIE['ess_maintbypass_template']) && $_COOKIE['ess_maintbypass_template'] == "ess1nf0tr33") ? array('maintenance/index') : null,
);
