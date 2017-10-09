<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$this->pageTitle = Yii::app()->name . ' - Example';
$this->breadcrumbs = array(
    'Example',
);
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'tbl-example-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form',
    )
));
?>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#modal" aria-controls="modal" role="tab" data-toggle="tab">Modal</a></li>
        <li role="presentation"><a href="#loading" aria-controls="loading" role="tab" data-toggle="tab">Loading</a></li>
        <li role="presentation"><a href="#form" aria-controls="form" role="tab" data-toggle="tab">Form</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="modal">
            <div class="well">
            <!-- Button trigger modal -->
            <?php echo CHtml::button('Launch demo modal', array('class' => 'btn btn-primary', 'data-toggle' => 'modal', 'data-target' => '#myModal')); ?>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="loading">
            <div class="well"><?php
                echo CHtml::button('Loading state', array('class' => 'btn btn-primary', 'data-loading-text' => 'Loading...', 'id' => 'myButton'));
            ?></div>
        </div>
        <div role="tabpanel" class="tab-pane" id="form">
            <div class="well">
                <div class="form-group">
                    <?php echo CHtml::label('Textfield with tooltip', 'input1', array('class' => 'col-sm-3')); ?>
                    <div class="col-sm-4">    
                        <?php echo CHtml::textField('input1','',array('class'=>'form-control', 'data-toggle'=>'tooltip', 'data-placement' => 'right', 'title' => 'Tooltip on right')); ?>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo CHtml::label('Use Toggle to change icon', '', array('class' => 'col-sm-3')); ?>
                    <div class="col-sm-4">
                        <span id="btn-toggle" style="cursor: pointer;" data-toggle="tooltip" title="Click me!"><span class="glyphicon glyphicon-thumbs-up" id="span-up"></span><span class="glyphicon glyphicon-thumbs-down" id="span-down" style="display:none;"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo CHtml::label('Dropdown list with optgroup', 'car_id', array('class' => 'col-sm-3')); ?>
                    <div class="col-sm-4">
                    <?php
                        echo CHtml::dropDownList('Cars', 'car_id', array(
                            'Mazda'=>array(
                                'mazda-rx7'=>'RX7',
                                'mazda-rx5'=>'RX5',
                            ),
                            'Volvo'=>array(
                                'volvo-b9tl'=>'B9TL',
                                'volvo-l90e-radlader'=>'L90E Radlader',
                            ),
                        ),array('empty'=>'--SELECT--','class'=>'form-control'));
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->endWidget(); ?>

<?php
Yii::app()->clientScript->registerScript('loading', '
$("#myButton").on("click", function () {
    var $btn = $(this);
    $btn.button("loading");
    // simulating a timeout
    setTimeout(function () {
        $btn.button("reset");
    }, 5000);
});
', CClientScript::POS_END);


Yii::app()->clientScript->registerScript('tooltip', '
$("[data-toggle=\"tooltip\"]").tooltip();
', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('toggle', '
$("#btn-toggle").on("click",function(){
    $("#span-up").toggle();
    $("#span-down").toggle();
});
', CClientScript::POS_END);
?>