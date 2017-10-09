<?php

class SiteController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'login' and 'contact' etc actions
                'actions' => array('login', 'contact', 'page', 'error', 'language', 'forgotPassword', 'changepass', 'sessionTimeout', 'processThemes'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'index' and 'logout' actions
                'actions' => array('index', 'logout', 'changePassword'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }        

        // if already login then redirect to previous page
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->user->returnUrl);
        }
        
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionLanguage($id) {
        if ($id == 0) {
            $lang = 'en';
        } else {
            $lang = 'ms';
        }
        Yii::app()->session['lang'] = $lang;

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionSessionTimeout() {
        $this->render('sessionTimeout');
    }

    public function actionForgotPassword() {
        $model = new ForgotForm;

        if (isset($_POST['ForgotForm'])) {
            $model->attributes = $_POST['ForgotForm'];

            if ($model->validate()) {

                // Find user account
                $details = User::model()->findAll('user_username=?', array($_POST['ForgotForm']['username'])); //print_r($details);exit;

                if ($details !== null) {
                    $date = date('d-m-Y H:i:s');
                    foreach ($details as $u) {
                        if (isset($u->users)) {
                            $timestamp = strtotime($date);
                            User::model()->updateByPk($u->users->user_id, array('reset_request' => $timestamp));

                            $EmailBody = 'You have requested to reset your password on ' . $date . ' .<br />';
                            $EmailBody .= 'Proceed this action by clicking the link below:<br />';
                            $EmailBody .= Yii::app()->createAbsoluteUrl('site/changepass', array('id' => $u->users->user_id, 't' => $timestamp)) . '<br /><br />';
                            $EmailBody .= 'Note: This link will expired after ONE day from requested date.';

                            $EmailSubject = Yii::t('app', 'Request to Reset Password');

                            $message = new YiiMailMessage;
                            $message->view = 'email_view';
                            $message->setBody(array('EmailBody' => $EmailBody), 'text/html');
                            $message->setSubject($EmailSubject);
                            $message->addTo($u->staff_email);
                            $message->from = Yii::app()->params['adminEmail'];

                            if (Yii::app()->mail->send($message)){
                                Yii::app()->user->setFlash('success', "Please check your email to proceed Reset your password");
                                $success = true;
                            }
                            else
                                Yii::app()->user->setFlash('error', "Send email error!");
                        }
                    }
                }
            }
        }

        $arr = array(
            'model' => $model,
        );
        if(isset($success))
            $arr['success'] = $success;
        
        $this->render('forgotpass', $arr);
    }
    
    public function actionChangepass(){ // for request reset password
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $t = isset($_GET['t']) ? $_GET['t'] : '';
        
        $model = User::model()->findByPk($id, 'reset_request = ? AND reset_request <= ?', array($t, strtotime(date('d-m-Y H:i:s'))));
        if($model!==null) 
            $model->scenario = 'changePwd';
            
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {
                $model->user_password = User::model()->cryptPass($model->new_password);
                $update = User::model()->updateByPk($id, array('user_password' => $model->user_password, 'reset_request' => null));

                if ($update>0){
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Password Changed successfully.'));
                    // $this->redirect(Yii::app()->createUrl('site/login'));
                    $model = null;
                    $success = true;
                }
                else{
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to Change Password.'));
                }
            }
        }
        
        $arr = array(
            'model' => $model,
        );
        if(isset($success))
            $arr['success'] = $success;
        
        $this->render('changepass', $arr);        
    }

    public function actionChangePassword($id) {
        $model = User::model()->findByPk($id);
        $model->scenario = 'changePwd';

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {
                $model->user_password = User::model()->cryptPass($model->new_password);
                $update = User::model()->updateByPk($id, array('user_password' => $model->user_password));

                if ($update>0){
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Password Changed successfully.'));
                }
                else{
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to Change Password.'));
                }
            }
            $model->new_password = '';
            $model->repeat_password = '';
        }

        $this->render('changePassword', array(
            'model' => $model,
        ));
    }
    
    public function actionProcessThemes() {
        if(Yii::app()->request->isPostRequest) {
//            var_dump($_POST);exit;
            $id = $_POST['id'];
            $modelAll = SysThemes::model()->findAll();
            $countSave = 0;
            $countData = count($modelAll);
            $result = true;
            
            // to destroy cookie
            if(isset($_COOKIE['url_id'])) {
                unset($_COOKIE['url_id']);
                setcookie('url_id', '', time() - 3600, '/'); // empty value and old timestamp
            }
            
            foreach ($modelAll as $mod) { 
                $model = SysThemes::model()->findByPk($mod->ID);
                
                if($mod->ID == $id) {
                    // to set cookie for themes
                    $cookie_name = 'url_id';
                    $cookie_value = $id;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                }
            }
            
            $message = Yii::t('app', 'Themes selected. Thank you.');
            Yii::app()->user->setFlash('success', $message);
            
            $response = array(
                'result' => $result,
            );
            
            echo CJSON::encode($response);
            
            Yii::app()->end();
        }
    }
}
