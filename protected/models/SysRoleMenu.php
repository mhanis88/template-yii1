<?php

/**
 * This is the model class for table "sys_role_menu".
 *
 * The followings are the available columns in table 'sys_role_menu':
 * @property integer $role_id
 * @property integer $menu_id
 */
class SysRoleMenu extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_role_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_id, menu_id', 'required'),
            array('role_id, menu_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('role_id, menu_id', 'safe', 'on' => 'search'),
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
            'menu_id' => 'Menu',
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
        $criteria->compare('menu_id', $this->menu_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysRoleMenu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /*
     * to find the list of division
     * Division::model()->getDivisionList();
     * return array
     */

    public function getAllowedMenu($role) {
        $model = SysRoleMenu::model()->findAll(array('condition' => 'role_id = :role', 'params' => array(':role' => $role)));
        $menu = [];

        foreach($model as $roleMenu){
            $menu[] = $roleMenu->menu_id;
        }
        return $menu;
    }

}
