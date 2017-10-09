<?php

class SysRoleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'deleteBulk'),
                'expression' => 'GeneralFunction::roleCheckerAction(Yii::app()->user->role,Yii::app()->controller)',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new SysRole;

        $access = [];
        $access['module'] = [];
        $access['controller'] = [];
        $access['action'] = [];
        
        $menu = [];
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysRole'])) {
            $model->attributes = $_POST['SysRole'];

            if ($model->validate()){
                if ($model->save(false)) {

                    if(isset($_POST['Action'])){
                        foreach($_POST['Action'] as $module => $value1){
                            foreach($value1 as $controller => $value2){
                                foreach($value2 as $action){
                                    $modelAccessRole = new SysRoleAccess;
                                    $modelAccessRole->role_id = $model->role_id;
                                    $modelAccessRole->module_id = $module;
                                    $modelAccessRole->controller_id = $controller;
                                    $modelAccessRole->action_id = $action;

                                    $modelAccessRole->save();
                                }
                            }
                        }
                    }

                    if(isset($_POST['Menu'])){
                        foreach($_POST['Menu'] as $menu){
                            $modelAccessMenu = new SysRoleMenu();
                            $modelAccessMenu->role_id = $model->role_id;
                            $modelAccessMenu->menu_id = $menu;

                            $modelAccessMenu->save();
                        }
                    }

                    Yii::app()->user->setFlash('success', Yii::t('app', 'Role added successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'access' => $access,
            'menu' => $menu,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $modelRoleAccess = SysRoleAccess::model()->findAll(array('condition' => 'role_id = :role', 'params' => array(':role' => $id)));
        $access = [];
        $access['module'] = [];
        $access['controller'] = [];
        $access['action'] = [];

        foreach($modelRoleAccess as $roleAccess){
            $access['module'][] = $roleAccess->module_id;
            $access['controller'][] = $roleAccess->controller_id;
            $access['action'][] = $roleAccess->action_id;
        }

        $menu = SysRoleMenu::model()->getAllowedMenu($id);
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysRole'])) {
            $model->attributes = $_POST['SysRole'];
            var_dump($_POST);

            if ($model->validate()){
                if ($model->save(false)) {

                    $delete = SysRoleAccess::model()->deleteAll(array('condition' => 'role_id = :role', 'params' => array(':role' => $model->role_id)));
                    if(isset($_POST['Action'])){
                        foreach($_POST['Action'] as $module => $value1){
                            foreach($value1 as $controller => $value2){
                                foreach($value2 as $action){
                                    $modelAccessRole = new SysRoleAccess;
                                    $modelAccessRole->role_id = $model->role_id;
                                    $modelAccessRole->module_id = $module;
                                    $modelAccessRole->controller_id = $controller;
                                    $modelAccessRole->action_id = $action;

                                    $modelAccessRole->save();
                                }
                            }
                        }
                    }

                    $delete = SysRoleMenu::model()->deleteAll(array('condition' => 'role_id = :role', 'params' => array(':role' => $model->role_id)));
                    if(isset($_POST['Menu'])){                        
                        foreach($_POST['Menu'] as $menu){
                            $modelAccessMenu = new SysRoleMenu;
                            $modelAccessMenu->role_id = $model->role_id;
                            $modelAccessMenu->menu_id = $menu;

                            $modelAccessMenu->save();
                        }
                    }

                    Yii::app()->user->setFlash('success', Yii::t('app', 'Role updated successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
            'access' => $access,
            'menu' => $menu,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('SysRole');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SysRole('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SysRole']))
            $model->attributes = $_GET['SysRole'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SysRole the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SysRole::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SysRole $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sys-role-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDeleteBulk() {
        if (Yii::app()->request->isPostRequest) {

            $response = array();

            $ids = $_POST['ids'];

            if (!empty($ids)) {

                $countRecord = count($ids);
                $successDelete = 0;
                
                $update = SysRole::model()->updateByPk($ids, array('is_delete' => 0));
                $successDelete = $update;

                if ($successDelete == $countRecord) {
                    $message = Yii::t('app', 'Role deleted successfully.');
                    $class = 'alert-success';
                } else {
                    $message = Yii::t('app', 'Unable to delete record.');
                    $class = 'alert-danger';
                }
            }

            $response = array(
                'message' => $message,
                'class' => $class,
            );

            echo CJSON::encode($response);
            Yii::app()->end();
        }
    }

}
