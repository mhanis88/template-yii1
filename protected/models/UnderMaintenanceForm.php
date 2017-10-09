<?php

/**
 * Osh on 24/11/2014
 * 
 * UnderMaintenanceForm class.
 * UnderMaintenanceForm is the data structure for keeping
 * under maintenance form data. It is used by the 'index' action of 'UnderMaintenance' controller.
 * 
 */
class UnderMaintenanceForm extends CFormModel {

    public $system;

    public function rules() {
        return array(
            array('system', 'required'),
        );
    }

    public function attributeLabels() {
        return array(
            'system' => Yii::t('app', 'System Status'),
        );
    }

}
