<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$this->pageTitle = Yii::app()->name .' - '. Yii::t('app','Session Timeout');
?>

<h3><?php echo Yii::t('app','Session Timeout') ?></h3>

<div class="error">
<?php echo Yii::t('app','Session timed out. Please <a href="'. Yii::app()->createUrl('site/login') .'">login</a> again to continue.'); ?>
</div>