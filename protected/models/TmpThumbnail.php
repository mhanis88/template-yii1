<?php

/**
 * This is the model class for table "tmp_thumbnail".
 *
 * The followings are the available columns in table 'tmp_thumbnail':
 * @property string $thumbnail_id
 * @property string $picture_ori
 * @property string $picture_tb
 */
class TmpThumbnail extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tmp_thumbnail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // array('type_name', 'required'),
            array('picture_tb', 'safe'),
            array('picture_ori', 'file', 'types'=>'jpg, gif, png', 'safe' => false),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('thumbnail_id, picture_ori, picture_tb', 'safe', 'on' => 'search'),
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
            'thumbnail_id' => 'ID',
            'picture_ori' => 'Picture',
            'picture_tb' => 'Thumbnail',
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

        $criteria->compare('thumbnail_id', $this->thumbnail_id, true);
        $criteria->compare('picture_ori', $this->picture_ori, true);
        $criteria->compare('picture_tb', $this->picture_tb, true);

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
            $this->thumbnail_id = GeneralFunction::randomgenerator();
            // $this->record_by = Yii::app()->user->id;
            // $this->record_date = new CDbExpression('NOW()');
        } else {
            $this->record_date = GeneralFunction::formatDate($this->record_date, "Y-m-d H:i:s");
            // $this->update_by = Yii::app()->user->id;
            // $this->update_date = new CDbExpression('NOW()');
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
        //$this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        //$this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");
        return parent::afterSave();
    }

    protected function afterFind() {
        //$this->record_date = GeneralFunction::formatDate($this->record_date, "d-m-Y H:i:s");
        //$this->update_date = GeneralFunction::formatDate($this->update_date, "d-m-Y");
        return parent::afterFind();
    }
}
