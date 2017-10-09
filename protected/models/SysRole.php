<?php

/**
 * This is the model class for table "sys_role".
 *
 * The followings are the available columns in table 'sys_role':
 * @property integer $role_id
 * @property string $role_name
 * @property string $role_desc
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 * @property integer $is_delete
 * @property string $role_access
 * @property string $role_menu
 *
 * The followings are the available model relations:
 * @property SysMenu[] $sysMenus
 * @property SysAction[] $sysActions
 */
class SysRole extends CActiveRecord {
    public $role_access;
    public $role_menu;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_role';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role_name', 'required'),
            array('is_delete', 'numerical', 'integerOnly' => true),
            array('role_name', 'length', 'max' => 100),
            array('record_by, update_by', 'length', 'max' => 50),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('role_id, role_name, role_desc, record_by, record_date, update_by, update_date, is_delete', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'menus' => array(self::MANY_MANY, 'SysMenu', 'sys_access_menu(role_id, menu_id)'),
            'actions' => array(self::MANY_MANY, 'SysAction', 'sys_access_role(role_id, action_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'role_id' => 'Role',
            'role_name' => 'Role Name',
            'role_desc' => 'Role Description',
            'record_by' => 'Record By',
            'record_date' => 'Record Date',
            'update_by' => 'Update By',
            'update_date' => 'Update Date',
            'is_delete' => 'Is Delete',
            'role_access' => 'Role Access',
            'role_menu' => 'Role Menu',
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
        $criteria->compare('role_name', $this->role_name, true);
        $criteria->compare('role_desc', $this->role_desc, true);
        $criteria->compare('record_by', $this->record_by, true);
        $criteria->compare('record_date', $this->record_date, true);
        $criteria->compare('update_by', $this->update_by, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('is_delete', $this->is_delete);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysRole the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->record_by = Yii::app()->user->id;
            $this->record_date = new CDbExpression('NOW()');
        } else {
            $this->record_date = GeneralFunction::formatDate($this->record_date, "Y-m-d H:i:s");
            $this->update_by = Yii::app()->user->id;
            $this->update_date = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }

    protected function afterSave() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y H:i:s");
        return parent::afterSave();
    }

    protected function afterFind() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y H:i:s");
        return parent::afterFind();
    }    
    
    /*
     * to find the list of role
     * SysRole::model()->getRoleList();
     * return array
     */

    public function getRoleList() {
        $criteria = array(
            'is_delete' => 0,
        );
        $model = SysRole::model()->findAllByAttributes($criteria, array('order' => 'role_name'));
        $list = CHtml::listData($model, 'role_id', 'role_name');
        return $list;
    }

}
