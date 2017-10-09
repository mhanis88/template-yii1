<?php
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
/**
 * This is the configuration for generating message translations
 * for the Yii framework. It is used by the 'yiic message' command.
 */
return array(
    'sourceLanguage'=>'en',
        'sourcePath'=>dirname(__FILE__).'/../',
        'messagePath'=>dirname(__FILE__).'/../messages',
        'languages'=>array('ms'), // this will be the folder which the file will be saved.
        'fileTypes'=>array('php'),
        'overwrite'=>true,
        'exclude'=>array(
                '.svn',
                '.gitignore',
                'yiilite.php',
                'yiit.php',
                '/i18n/data',
                '/messages',
                '/vendors',
                '/web/js',
                '/yii',
                '/extensions',
                '/migrations',
        ),
        'removeOld' => true,
        'sort' => true,
);

/*
 * how to use this using command prompt?
 * go to your framework yii folder (which my case would be D:\wamp\www\yii1116\framework) so that you can use yiic
 * then type yiic message root_path\<system_name>\protected\messages\config.php (which my case would be D:/wamp/www/yii_esciencefund/framework\protected\messages\config.php)
 * then hit enter
 */