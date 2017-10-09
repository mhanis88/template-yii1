<?php

class EditablesController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'view', 'deleteBulk', 'updateRecord', 'create1', 'createRecord', 'create2'),
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
        $model = new Editables;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Editables'])) {
            $model->attributes = $_POST['Editables'];

            /* uncomment if want to check duplication */
            /*
              $notExisting = $this->_notExisting($model);
              if (!$notExisting)
              {
              Yii::app()->user->setFlash('error', Yii::t('app', 'Record already exist.'));
              $skip = true;
              }
             */
            $model->editable_select2 = implode(',', $_POST['Editables']['editable_select2']);
            $model->editable_checkbox = implode(',', $_POST['Editables']['editable_checkbox']);

            if ($model->validate() && !isset($skip)) {
                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Editables added successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
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

        if (isset($_POST['Editables'])) {
            $model->attributes = $_POST['Editables'];

            /* uncomment if want to check duplication */
            /*
              $notExisting = $this->_notExisting($model, $id);
              if (!$notExisting)
              {
              Yii::app()->user->setFlash('error', Yii::t('app', 'Record already exist.'));
              $skip = true;
              }
             */
            $model->editable_select2 = implode(',', $_POST['Editables']['editable_select2']);
            $model->editable_checkbox = implode(',', $_POST['Editables']['editable_checkbox']);

            if ($model->validate() && !isset($skip)) {
                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Editables added successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
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
        $dataProvider = new CActiveDataProvider('Editables');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Editables('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Editables']))
            $model->attributes = $_GET['Editables'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Editables the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Editables::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Editables $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'editables-form') {
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

                /* if use update is_delete uncomment these  */
                // $deleteAction = Editables::model()->updateByPk($ids, array('is_active' => 0, 'is_delete' => 1));

                /* if use delete completely from database uncomment these */
                // $deleteAction = Editables::model()->deleteAllByAttributes(array('editable_id' => $ids));

                $successDelete = $deleteAction;

                if ($successDelete == $countRecord) {
                    $message = Yii::t('app', 'Editables deleted successfully.');
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

    /**
     * Performs column validation for duplication.
     * @param object $oBj from the model form
     * @param string $id primary key if provided
     * @return boolean true if not exist else false 
     */
    function _notExisting($oBj, $id = '') {
        $condition = array(
                // 'column_name' => $oBj->column_name, // check for duplication
        );
        $extra = '';
        if (!empty($id)) {
            $extra = array(
                'condition' => 'editable_id!=:id',
                'params' => array(':id' => $id)
            );
        }
        $modelExist = Editables::model()->findByAttributes($condition, $extra);
        return (count($modelExist) == 0 ? true : false);
    }

    public function actionUpdateRecord() {
        if (Yii::app()->request->isPostRequest) {
            $pk = isset($_POST['pk']) ? $_POST['pk'] : '';
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $value = isset($_POST['value']) ? $_POST['value'] : '';
            
            if($name=='editable_select2'){
                $ar_value = explode(',',$value);
                $ar_value = array_filter($ar_value);
                $value = implode(',',$ar_value);
            }
            elseif ($name=='editable_checkbox') {
                $value = implode(',',$value);
            }
            elseif ($name=='editable_date') {
                $value = GeneralFunction::formatDate($value, "Y-m-d");
            }

            if (!empty($pk) && !empty($name)) {
                $update = Editables::model()->updateByPk($pk, array($name => ($value!='' ? $value : null), 'update_date' => new CDbExpression('NOW()')));
                if ($update > 0) {
                    $message = Yii::t('app', 'Update success');
                    $class = 'alert-success';
                }
            }

            if (!isset($message)) {
                $message = Yii::t('app', 'No record updated');
                $class = 'alert-danger';
            }

            $arr = [
                'message' => $message,
                'class' => $class,
            ];

            echo CJSON::encode($arr);
            Yii::app()->end();
        } else {
            throw new CHttpException(400, 'Invalid request');
        }
    }
        
    public function actionCreateRecord() {
        if (Yii::app()->request->isPostRequest) {
            $model = new Editables;
            $model->attributes = $_POST;
            if ($model->save()) {
                echo CJSON::encode(array('id' => $model->primaryKey));
            } else {
                $errors = array_map(function($v) {
                    return join(', ', $v);
                }, $model->getErrors());
                echo CJSON::encode(array('errors' => $errors));
            }
        } else {
            throw new CHttpException(400, 'Invalid request');
        }
    }

    public function actionCreate1() {
        $model = new Editables;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Editables'])) {
            $model->attributes = $_POST['Editables'];

            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'User added successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }
        }

        $this->render('create1', array(
            'model' => $model,
        ));
    }

    public function actionCreate2() {
        $model = new Editables;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Editables'])) {
            $model->attributes = $_POST['Editables'];

            if ($model->validate()) {
                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'User added successfully.'));
                    $this->redirect(array('admin'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }
        }

        $this->render('create2', array(
            'model' => $model,
        ));
    }

    protected function gridSelect2($data, $row) {
        $arrValue = explode(',', $data->editable_select);
        return $this->findValue($arrValue); 
    }

    protected function gridSelect2Multi($data, $row) {
        $arrValue = explode(',', $data->editable_select2);
        return $this->findValue($arrValue); 
    }

    protected function gridCheckbox($data, $row) {
        $arrValue = explode(',', $data->editable_checkbox);
        return $this->findValue($arrValue); 
    }
    
    protected function findValue($value){
        $model = SysModule::model()->findAllByPk($value);
        $value = GeneralFunction::getUniqueKey($model, 'module_name');
        return implode(',',$value);
    }
}
