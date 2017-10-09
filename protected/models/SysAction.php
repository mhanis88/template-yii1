<?php

/**
 * This is the model class for table "sys_action".
 *
 * The followings are the available columns in table 'sys_action':
 * @property integer $action_id
 * @property string $action_name
 * @property string $action_desc
 * @property integer $controller_id
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 * @property string $module_id
 * @property boolean $pdf
 * @property integer $totalItemCount
 *
 * The followings are the available model relations:
 * @property SysRole[] $sysRoles
 * @property SysController $controller
 */
class SysAction extends CActiveRecord {

    public $module_id;
    public $pdf; // use for export gridview to pdf
    public $totalItemCount; // use for export gridview to pdf

    /**
     * @return string the associated database table name
     */

    public function tableName() {
        return 'sys_action';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('action_name, controller_id', 'required', 'on' => 'normalAction'),
            array('controller_id', 'required', 'on' => 'multipleAction'),
            array('controller_id', 'numerical', 'integerOnly' => true),
            array('action_name', 'length', 'max' => 100),
            array('action_desc', 'length', 'max' => 255),
            array('record_by, update_by', 'length', 'max' => 50),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('action_id, action_name, action_desc, controller_id, record_by, record_date, update_by, update_date, module_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'roles' => array(self::MANY_MANY, 'SysRole', 'sys_access_role(action_id, role_id)'),
            'controllers' => array(self::BELONGS_TO, 'SysController', ['controller_id' => 'controller_id']),
            'modules' => array(self::BELONGS_TO, 'SysModule', ['module_id' => 'module_id'], 'through' => 'controllers'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'action_id' => Yii::t('app', 'Action'),
            'action_name' => Yii::t('app', 'Action Name'),
            'action_desc' => Yii::t('app', 'Action Desc'),
            'controller_id' => Yii::t('app', 'Controller'),
            'record_by' => Yii::t('app', 'Record By'),
            'record_date' => Yii::t('app', 'Record Date'),
            'update_by' => Yii::t('app', 'Update By'),
            'update_date' => Yii::t('app', 'Update Date'),
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

        $criteria->with = array('controllers', 'modules');

        $criteria->compare('action_id', $this->action_id);
        $criteria->compare('action_name', $this->action_name, true);
        $criteria->compare('action_desc', $this->action_desc, true);
        $criteria->compare('t.controller_id', $this->controller_id);
        $criteria->compare('controllers.module_id', $this->module_id);
        $criteria->compare('record_by', $this->record_by, true);
        $criteria->compare('record_date', $this->record_date, true);
        $criteria->compare('update_by', $this->update_by, true);
        $criteria->compare('update_date', $this->update_date, true);

        $sort = new CSort;
        $sort->defaultOrder = [
                // 'seq' => CSort::SORT_ASC,
        ];
        $sort->attributes = [
            ///*
            'module_id' => [
                'asc' => 'modules.module_name',
                'desc' => 'modules.module_name DESC',
            ],
            // */
            '*',
        ];

        $arr = [
            'criteria' => $criteria,
            'sort' => $sort,
            // uncomment below to use dynamic pageSize
            ///*
            'pagination' => [
                'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
            ],
                // */
        ];

        if ($this->pdf) {
            unset($arr['pagination']);
            $arr['pagination'] = ['pageSize' => $this->totalItemCount];
        }

        return new CActiveDataProvider($this, $arr);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysAction the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            // $this->action_id = GeneralFunction::randomgenerator();
            $this->record_by = Yii::app()->user->id;
            $this->record_date = new CDbExpression('NOW()');
        } else {
            $this->record_date = GeneralFunction::formatDate($this->record_date, "Y-m-d H:i:s");
            $this->update_by = Yii::app()->user->id;
            $this->update_date = new CDbExpression('NOW()');
        }

        // Solution for Problem with foreign key on null fields
        $arrayForeignKeys = $this->tableSchema->foreignKeys;
        foreach ($this->attributes as $name => $value) {
            if (array_key_exists($name, $arrayForeignKeys) && $this->metadata->columns[$name]->allowNull && trim($value) == '') {
                $this->$name = null;
            }
        }

        return parent::beforeSave();
    }

    protected function afterSave() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");

        $this->module_id = isset($this->controllers) ? $this->controllers->module_id : '';
        return parent::afterSave();
    }

    protected function afterFind() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");

        $this->module_id = isset($this->controllers) ? $this->controllers->module_id : '';
        return parent::afterFind();
    }

}
