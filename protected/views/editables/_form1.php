<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

$tags = array(
    array('id' => 1, 'text' => 'php'),
    array('id' => 2, 'text' => 'html'),
    array('id' => 3, 'text' => 'css'),
    array('id' => 4, 'text' => 'javascript'),
);

$this->widget('editable.EditableDetailView', array(
    'data' => $model,
    //you can define any default params for child EditableFields 
    'url' => $this->createUrl('editable/updateRecord'), //common submit url for all fields
    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken), //params for all fields
    'emptytext' => 'no value',
    //'apply' => false, //you can turn off applying editable to all attributes
    'attributes' => array(
        array(
            'name' => 'editable_text',
            'editable' => array(
                'type' => 'text',
                'inputclass' => 'input-large',
                'emptytext' => 'special emptytext',
                'validate' => 'function(value) {
                        if(!value) return "User Name is required (client side)"
                    }'
            )
        ),
        array(//select loaded from database
            'name' => 'editable_select',
            'editable' => array(
                'type' => 'select',
                'source' => Editable::source(SysModule::model()->findAll(), 'module_id', 'module_name'),
            )
        ),
//        array(//select loaded from database
//            'name' => 'editable_select2',
//            'editable' => array(
//                'type' => 'select2',
//                'source' => $tags,
//                'select2' => array('multiple' => true),
//            )
//        ),
        array(//select loaded from ajax.
            'name' => 'editable_checkbox',
            'editable' => array(
                'type' => 'checklist',
                'source' => SysRole::model()->getRoleList(),
            )
        ),
        array(
            'name' => 'editable_date',
            'editable' => array(
                'type' => 'date',
                'viewformat' => 'dd-mm-yyyy'
            )
        ),
        'editable_textarea',
    //  'created_at', //will not be editable as attribute is not safe
    )
));
?>
<button id="save-btn" class="btn btn-primary">Save</button>
<?php
if ($model->isNewRecord) {
    Yii::app()->clientScript->registerScript('new-user', '
    $("#save-btn").click(function() {
        $(this).parent().parent().find(".editable").editable("submit", {
            url: "' . $this->createUrl('editables/createRecord') . '",
            data: ' . CJSON::encode(array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken)) . ',
            ajaxOptions: { dataType: "json" },                    
            success: function(data, config) {
                if(data && data.id) {
                    $(this).editable("option", "pk", data.id);
                    $(this).removeClass("editable-unsaved");
                    $("#msg").removeClass("alert-error").addClass("alert-success")
                             .html("User created! Now you can update it.").show();
                    $("#save-btn").hide();
                } else {
                    config.error.call(this, data && data.errors ? data.errors : "Unknown error");
                }
            },
            error: function(errors) {
                var msg = "";
                if(errors && errors.responseText) { 
                    msg = errors.responseText;
                } else {
                    $.each(errors, function(k, v) { msg += v+"<br>"; });
                } 
                $("#msg").removeClass("alert-success").addClass("alert-error")
                         .html(msg).show();         
             }
        });
    });
    ');
}
?>