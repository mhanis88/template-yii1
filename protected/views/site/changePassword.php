<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->breadcrumbs = array(
    Yii::t('app', 'Profile'),
    Yii::t('app', 'Change Password') => array('changePassword', 'id' => $model->user_id),
);
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo Yii::t('app', 'Change Password') ?></h3>
    </div>
    <div class="panel-body"><?php $this->renderPartial('_password', array('model' => $model)); ?></div>
</div>