<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ForgotForm extends CFormModel {

    public $email;
    public $username;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            // email has to be a valid email address
            array('username', 'required'),
            array('username', 'checkEmailExist'),
        );
    }

    public function checkEmail($attribute) {
        $user = User::model()->find('email=?', array($this->$attribute));

        if ($user === null)
            $this->addError($attribute, Yii::t('app', 'Email does not exist in system!'));
    }

    public function checkEmailExist($attribute) {
        $model = User::model()->find('user_username=?', array($this->$attribute));

        if ($model === null) {
            $this->addError($attribute, Yii::t('app', 'Username does not exist in system / User not active!'));
        } else {
            if (empty($model->email)) {
                $this->addError($attribute, Yii::t('app', 'No email found for this User!'));
            }
        }
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
        );
    }

}
