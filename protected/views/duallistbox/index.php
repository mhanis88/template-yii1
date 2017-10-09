<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$this->widget('ext.DualListBox.DualListBox', array(
    'model' => $model,
    'attribute' => 'menu_name',
    'nametitle' => 'Menu',
    'data' => $menuAll, // it will be displyed in available side
    'selecteddata' => $menuPublish, // it will be displayed in selected side
    'data_id' => 'menu_id',
    'data_value' => 'menu_name',
    'lngOptions' => array(
        // 'search_placeholder' => 'Menu',
        'showing' => ' - Showing',
        'available' => 'All',
        'selected' => 'Publish'
    )
));
?>

<?php echo date("t", strtotime('2016-02-01')); ?>
<i class="icon-envelope"></i>