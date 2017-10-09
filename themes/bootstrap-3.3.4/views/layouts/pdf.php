<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        
        <?php
        $baseThemeUrl = Yii::app()->theme->baseUrl;
        if (!empty(Yii::app()->params['bootstrap']) && !empty(Yii::app()->params['bootstrapTheme'])):
            Yii::app()->clientScript->registerCssFile($baseThemeUrl . '/'. Yii::app()->params['bootstrap'] .'/' . Yii::app()->params['bootstrapTheme'] . '/css/bootstrap.css');
        else:
            Yii::app()->clientScript->registerCssFile($baseThemeUrl . '/twitter/css/bootstrap.css');
            Yii::app()->clientScript->registerCssFile($baseThemeUrl . '/twitter/css/bootstrap-theme.css');
        endif;
        ?>        
    </head>
    <body>
        
    <?php echo $content; ?>
    
    </body>
</html>