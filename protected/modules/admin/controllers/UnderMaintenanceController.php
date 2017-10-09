<?php

class UnderMaintenanceController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index'),
                'expression' => 'GeneralFunction::roleCheckerAction(Yii::app()->user->role,Yii::app()->controller)',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $maint_file = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'runtime' . DIRECTORY_SEPARATOR . '.maintenance';

        $model = new UnderMaintenanceForm;

        if (isset($_POST['UnderMaintenanceForm'])) {
            $model->attributes = $_POST['UnderMaintenanceForm'];
            if ($model->validate()) {
                if ($_POST['UnderMaintenanceForm']['system'] == 1) {
                    if (!file_exists($maint_file)) {
                        // Create cookie to bypass under maintenance catchall
                        $cookieDays = 180;
                        $cookie = new CHttpCookie(Yii::app()->params['cookieName'], Yii::app()->params['cookieValue']);
                        $cookie->expire = time() + 60 * 60 * 24 * $cookieDays;
                        Yii::app()->request->cookies[Yii::app()->params['cookieName']] = $cookie;
                        // Create .maintenance file
                        $create_maint_file = fopen($maint_file, "w");
                        Yii::app()->user->setFlash('success', Yii::t('app', 'System is now Under Maintenance!'));
                    }
                } else {
                    if (file_exists($maint_file)) {
                        // Delete .maintenance file
                        unlink($maint_file);
                        // Delete bypass cookie
                        if (isset(Yii::app()->request->cookies[Yii::app()->params['cookieName']]))
                            unset(Yii::app()->request->cookies[Yii::app()->params['cookieName']]);
                        Yii::app()->user->setFlash('success', Yii::t('app', 'System is now Online!'));
                    }
                }
            }
        }

        // Get current system status
        if (file_exists($maint_file)) {
            $model->system = 1; // system is under maintenance
        } else {
            $model->system = 0; // system is online
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

}
