<?php

/**
 * This is the model class for table "tbl_editable".
 *
 * The followings are the available columns in table 'tbl_editable':
 * @property string $editable_id
 * @property string $editable_text
 * @property string $editable_textarea
 * @property string $editable_select
 * @property string $editable_select2
 * @property string $editable_checkbox
 * @property string $editable_date
 * @property string $record_date
 * @property string $update_date
 * @property integer $is_delete
 */
class Editables extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tbl_editable';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('editable_text', 'required'),
            array('is_delete', 'numerical', 'integerOnly' => true),
            // array('editable_id, editable_select, editable_checkbox', 'length', 'max' => 50),
            // array('editable_text, editable_select', 'length', 'max' => 255),
            array('editable_textarea, editable_select, editable_select2, editable_checkbox, editable_date', 'safe'),
            array('editable_date', 'default', 'value' => null),
            // array('editable_select2', 'implodeParams'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('editable_id, editable_text, editable_textarea, editable_select, editable_select2, editable_checkbox, editable_date, record_date, update_date, is_delete', 'safe', 'on' => 'search'),
        );
    }

    public function implodeParams($attribute) {
        if (is_array($this->$attribute)) {
            $this->$attribute = implode(',', $this->$attribute);  //in db it is stored as string e.g. '1,3,4'
        }
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
            'editable_id' => 'Editable',
            'editable_text' => 'Editable Text',
            'editable_textarea' => 'Editable Textarea',
            'editable_select' => 'Editable Select',
            'editable_select2' => 'Editable Select2',
            'editable_checkbox' => 'Editable Checkbox',
            'editable_date' => 'Editable Date',
            'record_date' => 'Record Date',
            'update_date' => 'Update Date',
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

        $criteria->compare('editable_id', $this->editable_id, true);
        $criteria->compare('editable_text', $this->editable_text, true);
        $criteria->compare('editable_textarea', $this->editable_textarea, true);
        $criteria->compare('editable_select', $this->editable_select, true);
        $criteria->compare('editable_select2', $this->editable_select2, true);
        $criteria->compare('editable_checkbox', $this->editable_checkbox, true);
        $criteria->compare('editable_date', $this->editable_date, true);
        $criteria->compare('record_date', $this->record_date, true);
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
     * @return Editables the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->editable_id = GeneralFunction::randomgenerator();
            $this->record_date = new CDbExpression('NOW()');
        } else {
            $this->record_date = GeneralFunction::formatDate($this->record_date, "Y-m-d H:i:s");
            $this->update_date = new CDbExpression('NOW()');
        }
        
        $this->editable_date = GeneralFunction::formatDate($this->editable_date, "Y-m-d");

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
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y H:i:s");
        return parent::afterSave();
    }

    protected function afterFind() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y H:i:s");
        
        $this->editable_date = GeneralFunction::formatDate($this->editable_date, "d-m-Y");
        return parent::afterFind();
    }

}
