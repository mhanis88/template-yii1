<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>



<?php
$this->widget(
    'booster.widgets.TbBreadcrumbs',
    array(
        'links' => array('YiiBooster'=>Yii::app()->createUrl('booster/index')),
    )
);

echo '
    
<pre>
<b>to enable YiiBooster only on controllers and actions you really need it.</b>

public function filters() {
    return array(
        ... probably other filter specifications ...
        array(\'path.alias.to.booster.filters.BoosterFilter - delete\')
    );
}

* in our case => array(\'ext.booster.filters.BoosterFilter - delete\')
</pre>
';

$tabs = array(
            array(
                'label' => 'Modal',
                'content' => $this->renderPartial('_modal', null, true),
                'active' => true
            ),
            array(
                'label' => 'GridView', 
                'content' => $this->renderPartial('_gridView', null, true)
            ),
            array(
                'label' => 'Input', 
                'content' => $this->renderPartial('_input', null, true)
            ),
            array(
                'label' => 'Other', 
                'content' => $this->renderPartial('_other1', null, true) . $this->renderPartial('_other2', null, true),
            ),
        );

$this->widget(
    'booster.widgets.TbTabs',
    array(
//        'justified' => true,
        'type' => 'tabs',
        'tabs' => $tabs
    )
);
?>