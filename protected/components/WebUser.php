<?php

/*
 * Added by Osh
 * This class is for storing logged in user info
 * User info stored in Yii::app()->user object
 * Example: Yii::app()->user->cvid to access the getter function getCvid
 * 
 */

class WebUser extends CWebUser {

    private $_model;

    // Getter function to return user Primary Key
    public function getPkey() {
        $model = $this->loadModel(Yii::app()->user->id);
        return isset($model->user_id) ? $model->user_id : null;
    }

    /*
     * Getter function to return username
     * how to use: Yii::app()->user->name
     */

    public function getName() {
        $model = $this->loadModel(Yii::app()->user->id);
        return isset($model->user_username) ? $model->user_username : null;
    }

    /*
     * Getter function to return user fullname
     * how to use: Yii::app()->user->fName
     */

    public function getFName() {
        $model = $this->loadModel2(Yii::app()->user->id);
        return isset($model->full_name) ? $model->full_name : null;
    }

    public function getEmail() {
        $model = $this->loadModel2(Yii::app()->user->id);
        return isset($model->email) ? $model->email : null;
    }

    /*
     * Getter function to return user role
     * how to use: Yii::app()->user->role
     */

    public function getRole() {
        $model = $this->loadModel(Yii::app()->user->id);
        return isset($model->role_id) ? $model->role_id : null;
    }

    /*
     * Getter function to return user role name
     * how to use: Yii::app()->user->role
     */

    public function getRoleName() {
        $role_id = $this->getRole();
        if ($role_id !== null) {
            $modelRole = SysRole::model()->findByPk($role_id);
            return isset($modelRole->role_name) ? $modelRole->role_name : null;
        }
        return null;
    }

    public function loadModel($id = null) {
        if ($id !== null) {
            if ($this->_model === null)
                $this->_model = User::model()->find('user_id=?', array($id));
        }
        return $this->_model;
    }

}
