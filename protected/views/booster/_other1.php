<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<div>';
$this->widget(
    'booster.widgets.TbButton',
    array(
        'label' => 'Free notifications here',
        'htmlOptions' => array(
            'onclick' => 'js:$.notify("Hi! Look here!", "info")'
        )
    )
);
echo '</div>';