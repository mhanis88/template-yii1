<?php

/**
 * This is the model class for table "vw_role_access".
 *
 * The followings are the available columns in table 'vw_role_access':
 * @property integer $role_id
 * @property integer $module_id
 * @property integer $controller_id
 * @property integer $action_id
 * @property string $module_name
 * @property string $controller_name
 * @property string $action_name
 */
class VwRoleAccess extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'vw_role_access';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_id, module_id, controller_id, action_id', 'required'),
            array('role_id, module_id, controller_id, action_id', 'numerical', 'integerOnly' => true),
            array('module_name, controller_name, action_name', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('role_id, module_id, controller_id, action_id, module_name, controller_name, action_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'role_id' => 'Role',
            'module_id' => 'Module',
            'controller_id' => 'Controller',
            'action_id' => 'Action',
            'module_name' => 'Module Name',
            'controller_name' => 'Controller Name',
            'action_name' => 'Action Name',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('module_id', $this->module_id);
        $criteria->compare('controller_id', $this->controller_id);
        $criteria->compare('action_id', $this->action_id);
        $criteria->compare('module_name', $this->module_name, true);
        $criteria->compare('controller_name', $this->controller_name, true);
        $criteria->compare('action_name', $this->action_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return VwRoleAccess the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
