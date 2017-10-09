
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading">Panel heading</div>
  <div class="panel-body">...</div>
    <?php
    // $gridDataProvider
    $mark = new Person();
    $mark->id = 1;
    $mark->firstName = 'Mark';
    $mark->lastName = 'Otto';
    $mark->language = 'CSS';
    $mark->hours = 10;

    $jacob = new Person();
    $jacob->id = 2;
    $jacob->firstName = 'Jacob';
    $jacob->lastName = 'Thornton';
    $jacob->language = 'JavaScript';
    $jacob->hours = 20;

    $stu = new Person();
    $stu->id = 3;
    $stu->firstName = 'Stu';
    $stu->lastName = 'Dent';
    $stu->language = 'HTML';
    $stu->hours = 10;

    $persons = array($mark, $jacob, $stu);

    $gridDataProvider = new CArrayDataProvider($persons);

    // $gridColumns
    $gridColumns = array(
        array('name' => 'id', 'header' => '#', 'htmlOptions' => array('style' => 'width: 60px')),
        array('name' => 'firstName', 'header' => 'First name'),
        array('name' => 'lastName', 'header' => 'Last name'),
        array('name' => 'language', 'header' => 'Language'),
        array('name' => 'hours', 'header' => 'Hours worked'),
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'class' => 'booster.widgets.TbButtonColumn',
            'viewButtonUrl' => null,
            'updateButtonUrl' => null,
            'deleteButtonUrl' => null,
        )
    );

    $person = new Person();

    $this->widget(
            'booster.widgets.TbGridView', array(
        'dataProvider' => $gridDataProvider,
        'template' => "{items}",
        'columns' => $gridColumns,
                'type' => 'striped',
            )
    );
    ?>
</div>