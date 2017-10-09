<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        /*
         * set the time out once this function trigger
         */
        Yii::app()->user->setState('userSessionTimeout', time()+Yii::app()->params['sessionTimeoutSeconds'] );

        $model = User::model()->find('LOWER(user_username)=?', array(strtolower($this->username)));
        // var_dump($model);
        $currentPassword = '';
        if(isset($model->user_password)){
            $currentPassword = $model->user_password;
        }
        if ($model === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if (!$model->verifyPass($this->password, $currentPassword)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $model->user_id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
        
        /*
        $users = array(
            // username => password
            'demo' => 'demo',
            'admin' => 'admin',
        );
        if (!isset($users[$this->username]))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($users[$this->username] !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
         */
    }

    public function getId() {
        return $this->_id;
    }

}
