<?php

class SysControllerController extends Controller {

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
        $model = new SysController;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysController'])) {
            $model->attributes = $_POST['SysController'];

            $notExisting = $this->_notExisting($model);

            if ($model->validate() && $notExisting) {
                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Controller added successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }

            if (!$notExisting) {
                Yii::app()->user->setFlash('error', Yii::t('app', 'Record already exist.'));
                $model->unsetAttributes();
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysController'])) {
            $model->attributes = $_POST['SysController'];

            $notExisting = $this->_notExisting($model, $id);
            
            if ($model->validate() && $notExisting) {
                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Controller updated successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }

            if (!$notExisting) {
                Yii::app()->user->setFlash('error', Yii::t('app', 'Record already exist.'));
                $model = $this->loadModel($id);
            }
        }

        $this->render('update', array(
            'model' => $model,
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
        $dataProvider = new CActiveDataProvider('SysController');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SysController('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SysController']))
            $model->attributes = $_GET['SysController'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SysController the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SysController::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SysController $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sys-controller-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    function _notExisting($oBj, $currectId = '') {
        $condition = array(
            'controller_name' => $oBj->controller_name,
            'module_id' => $oBj->module_id,
        );
        $extra = '';
        if (!empty($currectId)) {
            $extra = array(
                'condition' => 'controller_id!=:id',
                'params' => array(':id' => $currectId)
            );
        }
        $modelExist = SysController::model()->findByAttributes($condition, $extra);
        return (count($modelExist) == 0 ? true : false);
    }

    public function actionDeleteBulk() {
        if (Yii::app()->request->isPostRequest) {

            $response = array();

            $ids = $_POST['ids'];

            if (!empty($ids)) {

                $countRecord = count($ids);
                $successDelete = 0;
                
                $deleteAction = SysAction::model()->deleteAllByAttributes(array('controller_id' => $ids));
                $deleteController = SysController::model()->deleteAllByAttributes(array('controller_id' => $ids));
                $successDelete = $deleteController;

                if ($successDelete == $countRecord) {
                    $message = Yii::t('app', 'Controller deleted successfully.');
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
