

<div class="col-sm-7">Select2
    <?php
    $this->widget(
            'booster.widgets.TbSelect2', array(
        'asDropDownList' => false,
        'name' => 'clevertech',
        'options' => array(
            'tags' => array('clever', 'is', 'better', 'clevertech'),
            'placeholder' => 'type clever, or is, or just type!',
            'width' => '100%',
            'tokenSeparators' => array(',', ' ')
        )
            )
    );
    ?>
</div>
<div class="col-sm-7">CKEditor
    <?php
    $this->widget(
            'booster.widgets.TbCKEditor', array(
        'name' => 'some_random_text_field',
        'editorOptions' => array(
            // From basic `build-config.js` minus 'undo', 'clipboard' and 'about'
            'plugins' => 'basicstyles,toolbar,enterkey,entities,floatingspace,wysiwygarea,indentlist,link,list,dialog,dialogui,button,indent,fakeobjects'
        )
            )
    );
    ?>
</div>
<div class="col-sm-7">
    <?php
    $model = new Person();
    $model->shortname = 'Fake Data';
    $this->widget(
            'booster.widgets.TbEditableField', array(
        'type' => 'text',
        'model' => $model,
        'attribute' => 'shortname', // $model->name will be editable
        // 'url' => '', //url for submit data
        'placement' => 'right', // right, top, left, bottom
            )
    );
    ?>
</div>
<div class="col-sm-7">
    <?php
    $model->longname = 'Fake Data for TextArea';
    $this->widget('booster.widgets.TbEditableField', array(
        'type' => 'textarea',
        'model' => $model,
        'attribute' => 'longname',
        // 'url' => $endpoint, //url for submit data
        'placement' => 'right', // right, top, left, bottom
    ));
    ?>
</div>
<div class="col-sm-7">
    <?php
    $model->select2name = 'Fake Data for TextArea';
    $this->widget('booster.widgets.TbEditableField', array(
        'type' => 'select2',
        'model' => $model,
        'attribute' => 'select2name',
        // 'url' => $endpoint, //url for submit data
        'source' => array('Choose', 'your', 'destiny', '.'),
        'placement' => 'right', // right, top, left, bottom
    ));
    ?>
</div>
<div class="col-sm-7">
    <?php
    $model->datename = date('d-m-Y');
    $this->widget(
            'booster.widgets.TbEditableField', array(
        'type' => 'date',
        'model' => $model,
        'attribute' => 'datename',
        // 'url' => $endpoint, //url for submit data
        'placement' => 'right',
        'format' => 'dd-mm-yyyy',
        'viewformat' => 'dd-mm-yyyy',
        'options' => array(
//            'datepicker' => array(
//                'language' => 'en'
//            )
        )
            )
    );
    ?>
</div>
<div class="col-sm-7">
    Yii Booster Active Form example : <a href="http://yiibooster.clevertech.biz/widgets/forms/view/activeform.html">Active Form</a>
</div>