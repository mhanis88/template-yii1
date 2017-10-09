<?php

/**
 * This is the model class for table "sys_module".
 *
 * The followings are the available columns in table 'sys_module':
 * @property integer $module_id
 * @property string $module_name
 * @property string $module_desc
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property SysController[] $sysControllers
 */
class SysModule extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_module';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('module_name', 'required'),
            array('module_name', 'length', 'max' => 100),
            array('module_desc', 'length', 'max' => 255),
            array('record_by, update_by', 'length', 'max' => 50),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('module_id, module_name, module_desc, record_by, record_date, update_by, update_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sysControllers' => array(self::HAS_MANY, 'SysController', 'module_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'module_id' => 'Module',
            'module_name' => 'Module Name',
            'module_desc' => 'Module Desc',
            'record_by' => 'Record By',
            'record_date' => 'Record Date',
            'update_by' => 'Update By',
            'update_date' => 'Update Date',
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

        $criteria->compare('module_id', $this->module_id);
        $criteria->compare('module_name', $this->module_name, true);
        $criteria->compare('module_desc', $this->module_desc, true);
        $criteria->compare('record_by', $this->record_by, true);
        $criteria->compare('record_date', $this->record_date, true);
        $criteria->compare('update_by', $this->update_by, true);
        $criteria->compare('update_date', $this->update_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysModule the static model class
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
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");

        return parent::afterSave();
    }

    protected function afterFind() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");
        
        return parent::afterFind();
    }

    /*
     * to find the list of module
     * SysModule::model()->getModuleList();
     * return array
     */

    public function getModule() {
        $criteria = array(
            // 'is_active' => 1,
            // 'is_delete' => 0,
        );
        $model = SysModule::model()->findAllByAttributes($criteria, array('order' => 'module_name'));
        $module = [];
        
        $module['gii'] = array(
            'class' => 'system.gii.GiiModule',
            'password' => 'adm1n',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        );
        
        foreach($model as $value){
            array_push($module,$value->module_name);
        }
        // $module = substr_replace( $module, "", -1 );
        return $module;
    }

    /*
     * to find the list of module
     * SysModule::model()->getModuleList();
     * return array
     */

    public function getModuleList() {
        $criteria = array(
            // 'is_active' => 1,
            // 'is_delete' => 0,
        );
        $model = SysModule::model()->findAllByAttributes($criteria, array('order' => 'module_name'));
        $list = CHtml::listData($model, 'module_id', 'module_name');
        return $list;
    }

}
