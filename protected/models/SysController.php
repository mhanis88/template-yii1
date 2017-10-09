<?php

/**
 * This is the model class for table "sys_controller".
 *
 * The followings are the available columns in table 'sys_controller':
 * @property integer $controller_id
 * @property string $controller_name
 * @property string $controller_desc
 * @property integer $module_id
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 *
 * The followings are the available model relations:
 * @property SysAction[] $sysActions
 * @property SysModule $module
 */
class SysController extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_controller';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('controller_name, module_id', 'required'),
            array('module_id', 'numerical', 'integerOnly' => true),
            array('controller_name', 'length', 'max' => 100),
            array('controller_desc', 'length', 'max' => 255),
            array('record_by, update_by', 'length', 'max' => 50),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('controller_id, controller_name, controller_desc, module_id, record_by, record_date, update_by, update_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'actions' => array(self::HAS_MANY, 'SysAction', 'controller_id'),
            'modules' => array(self::BELONGS_TO, 'SysModule', 'module_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'controller_id' => 'Controller',
            'controller_name' => 'Controller Name',
            'controller_desc' => 'Controller Desc',
            'module_id' => 'Module',
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

        $criteria->compare('controller_id', $this->controller_id);
        $criteria->compare('controller_name', $this->controller_name, true);
        $criteria->compare('controller_desc', $this->controller_desc, true);
        $criteria->compare('module_id', $this->module_id);
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
     * @return SysController the static model class
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
     * to find the list of controller
     * SysController::model()->getControllerList();
     * return array
     */

    public function getControllerList($module='') {
        $criteria = array(
            // 'is_active' => 1,
            // 'is_delete' => 0,
        );
        if(!empty($module)){
            $criteria['module_id'] = $module;
        }
        $model = SysController::model()->findAllByAttributes($criteria, array('order' => 'controller_name'));
        $list = CHtml::listData($model, 'controller_id', 'controller_name');
        return $list;
    }

}
