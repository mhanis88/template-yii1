<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$model = new Person();
echo '<div>';
$this->widget(
    'booster.widgets.TbHighCharts',
    array(
        'options' => array(
            'series' => array(
                [
                    'data' => [1, 2, 3, 4, 5, 1, 2, 1, 4, 3, 1, 5]
                ]
            )
        )
    )
);
echo '</div>';

echo '<div>';
$this->widget(
    'booster.widgets.TbSwitch',
    array(
        'name' => 'testToggleButton',
        'events' => array(
            'switchChange' => 'js:function($el, status, e){console.log($el, status, e);}'
        )
    )
);
echo '</div>';