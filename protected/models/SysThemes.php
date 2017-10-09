<?php

/**
 * This is the model class for table "sys_themes".
 *
 * The followings are the available columns in table 'sys_themes':
 * @property integer $ID
 * @property string $filename
 * @property string $parent_file
 * @property integer $is_active
 * @property integer $is_delete
 */
class SysThemes extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sys_themes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_active, is_delete', 'numerical', 'integerOnly' => true),
            array('filename, parent_file', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('ID, filename, parent_file, is_active, is_delete', 'safe', 'on' => 'search'),
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
            'ID' => 'ID',
            'filename' => 'Filename',
            'parent_file' => 'Parent File',
            'is_active' => 'Is Active',
            'is_delete' => 'Is Delete',
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

        $criteria->compare('ID', $this->ID);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('parent_file', $this->parent_file, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_delete', $this->is_delete);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SysThemes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getOptionList() {
        $model = SysThemes::model()->findAllByAttributes(array('is_delete' => 0));
        $list = CHtml::listData($model, 'ID', 'filename');

        return $list;
    }

    public static function getCurrentThemesByID() {
        $model = SysThemes::model()->findByAttributes(array('is_active' => 1, 'is_delete' => 0));
        $result = $model->ID;

        return $result;
    }

    public static function getCurrentThemesByName() {
        $model = SysThemes::model()->findByAttributes(array('is_active' => 1, 'is_delete' => 0));
        $result = $model->filename;

        return $result;
    }

    public static function getCurrentThemesByParentName() {
        $model = SysThemes::model()->findByAttributes(array('is_active' => 1, 'is_delete' => 0));
        $result = $model->parent_file;

        return $result;
    }

    public static function getActiveTheme() {
        return SysThemes::model()->countByAttributes(array('is_active' => 1, 'is_delete' => 0));
    }

}
