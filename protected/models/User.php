<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property string $user_id
 * @property string $user_username
 * @property string $user_password
 * @property string $email
 * @property integer $role_id
 * @property string $reset_request
 * @property string $record_by
 * @property string $record_date
 * @property string $update_by
 * @property string $update_date
 * @property integer $is_delete
 * @property string $new_password
 * @property string $repeat_password
 * @property boolean $pdf
 * @property integer $totalItemCount
 *
 * The followings are the available model relations:
 * @property SysRole $role
 */
class User extends CActiveRecord {

    public $new_password;
    public $repeat_password;
    public $pdf; // use for export gridview to pdf
    public $totalItemCount; // use for export gridview to pdf

    /**
     * @return string the associated database table name
     */

    public function tableName() {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_username, user_password, email, role_id', 'required'),
            array('role_id, is_delete', 'numerical', 'integerOnly' => true),
            array('user_username, email', 'length', 'max' => 128),
            array('email', 'email'),
            array('record_date, update_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('user_id, user_username, user_password, email, role_id, reset_request, record_by, record_date, update_by, update_date, is_delete', 'safe', 'on' => 'search'),
            array('new_password, repeat_password', 'required', 'on' => 'changePwd'),
            array('repeat_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'changePwd'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'role' => array(self::BELONGS_TO, 'SysRole', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'user_id' => Yii::t('app', 'User'),
            'user_username' => Yii::t('app', 'User Username'),
            'user_password' => Yii::t('app', 'User Password'),
            'email' => Yii::t('app', 'Email'),
            'role_id' => Yii::t('app', 'Role'),
            'reset_request' => Yii::t('app', 'Reset Request'),
            'record_by' => Yii::t('app', 'Record By'),
            'record_date' => Yii::t('app', 'Record Date'),
            'update_by' => Yii::t('app', 'Update By'),
            'update_date' => Yii::t('app', 'Update Date'),
            'is_delete' => Yii::t('app', 'Is Delete'),
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

        $criteria->compare('user_id', $this->user_id, true);
        $criteria->compare('user_username', $this->user_username, true);
        $criteria->compare('user_password', $this->user_password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('role_id', $this->role_id);
        $criteria->compare('reset_request', $this->reset_request, true);
        $criteria->compare('record_by', $this->record_by, true);
        $criteria->compare('record_date', $this->record_date, true);
        $criteria->compare('update_by', $this->update_by, true);
        $criteria->compare('update_date', $this->update_date, true);
        $criteria->compare('is_delete', 0);

        $sort = new CSort;
        $sort->defaultOrder = [
                // 'seq' => CSort::SORT_ASC,
        ];
        $sort->attributes = [
            /*
              'new_created_column_name' => [
              'asc' => 'column_name',
              'desc' => 'column_name DESC',
              ],
             */
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
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeSave() {
        if ($this->isNewRecord) {
            $this->user_id = GeneralFunction::randomgenerator();
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

    /**
     * Hanis on 10/6/2015 : crypt and verify through CPasswordHelper
     * @param type $password
     * @return type
     * 
     */
    public function cryptPass($password) {
        return CPasswordHelper::hashPassword($password);
    }

    public function verifyPass($password, $crypted) {
        return CPasswordHelper::verifyPassword($password, $crypted);
    }

}
