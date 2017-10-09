

<?php
$this->beginWidget(
        'booster.widgets.TbModal', array('id' => 'myModal')
);
?>


<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Modal header</h4>
</div>

<div class="modal-body">
    <p>One fine body...</p>
</div>

<div class="modal-footer">
    <?php
    $this->widget(
            'booster.widgets.TbButton', array(
        'context' => 'primary',
        'label' => 'Save changes',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
            )
    );

    $this->widget(
            'booster.widgets.TbButton', array(
        'label' => 'Close',
        'url' => '#',
        'htmlOptions' => array('data-dismiss' => 'modal'),
            )
    );
    ?>
</div>

<?php $this->endWidget(); ?>

<div class="well">
    <?php
    $this->widget(
            'booster.widgets.TbButton', array(
        'label' => 'Click me to open Modal (problem)',
        'context' => 'primary',
        'htmlOptions' => array(
            'data-toggle' => 'modal',
            'data-target' => '#myModal',
        ),
            )
    );
    echo '&nbsp;&nbsp;&nbsp;';
    $this->widget(
            'booster.widgets.TbButton', array(
        'label' => 'Click me to open Modal',
        'context' => 'primary',
        'htmlOptions' => array(
            'id' => 'buttonopenmodal',
        ),
            )
    );
    ?>
</div>
<?php
  Yii::app()->clientScript->registerScript('script_id','
  $("#buttonopenmodal").on("click", function () {
  $("#myModal").modal("show");
  });
  ', CClientScript::POS_READY);
?>
