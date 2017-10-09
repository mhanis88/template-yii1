<?php

/**
 * This is the model class for table "tmp_type".
 *
 * The followings are the available columns in table 'tmp_type':
 * @property string $type_id
 * @property string $type_name
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 * @property integer $is_active
 * @property integer $is_delete
 */
class TmpType extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tmp_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type_name', 'required'),
            array('is_active, is_delete', 'numerical', 'integerOnly' => true),
            array('type_id, type_name, record_by, update_by', 'length', 'max' => 50),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('type_id, type_name, record_by, record_date, update_by, update_date, is_active, is_delete', 'safe', 'on' => 'search'),
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
            'type_id' => 'Type',
            'type_name' => 'Type Name',
            'record_by' => 'Record By',
            'record_date' => 'Record Date',
            'update_by' => 'Update By',
            'update_date' => 'Update Date',
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

        $criteria->compare('type_id', $this->type_id, true);
        $criteria->compare('type_name', $this->type_name, true);
        $criteria->compare('record_by', $this->record_by, true);
        $criteria->compare('record_date', $this->record_date, true);
        $criteria->compare('update_by', $this->update_by, true);
        $criteria->compare('update_date', $this->update_date, true);
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
     * @return TmpType the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->type_id = GeneralFunction::randomgenerator();
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
        return parent::afterSave();
    }

    protected function afterFind() {
        $this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        $this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");
        return parent::afterFind();
    }
    
    public function getOptionList() {
        $criteria = new CDbCriteria;
        $criteria->compare('is_active', 1);
        $criteria->compare('is_delete', 0);
        $criteria->order = 'type_name';
        $model = TmpType::model()->findAll($criteria);
        $list = CHtml::listData($model, 'type_id', 'type_name');
        return $list;
    }
}
