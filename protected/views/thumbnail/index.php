<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
        ));
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'picture_ori', array('class' => 'col-sm-2')); ?>
    <div class="col-sm-4">
        <?php echo $form->fileField($model, 'picture_ori', array('class' => '')) ?>
    </div>
    <div class="col-sm-4">
        <?php echo $form->error($model, 'picture_ori'); ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
        <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Save'), array('class' => 'btn btn-primary')); ?>
        <?php echo CHtml::resetButton(Yii::t('app', 'Reset'), array('class' => 'btn btn-default')); ?>
        <?php echo CHtml::link(Yii::t('app', 'Back'), Yii::app()->createUrl('thumbnail/index'), array('class' => 'btn btn-default')) ?>
    </div>
</div>

<?php
// echo new CDbExpression('NOW()');
if (count($modelThumbnail) > 0):

    $this->widget('ext.fancybox.EFancyBox', array(
        'target' => 'a[rel=gallery1]',
        'config' => array(
            'autoDimensions' => true,
        ),
            )
    );

    $pathFolder = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . Yii::app()->params['fileUploadDir'] . DIRECTORY_SEPARATOR;
    $pathFolder = str_replace('\\', '/', $pathFolder);

    foreach ($modelThumbnail as $tb):
        echo '
<a class="fancybox" rel="gallery1" href="' . $pathFolder . $tb->picture_ori . '" title="' . $tb->picture_ori . '">
    <img src="' . $pathFolder . $tb->picture_tb . '" alt="" />
</a>';
    endforeach;
endif;
?>

<?php $this->endWidget(); ?>