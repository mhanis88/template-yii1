<?php

class SysActionController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'deleteBulk', 'deleteAction'),
                'expression' => 'GeneralFunction::roleCheckerAction(Yii::app()->user->role,Yii::app()->controller)',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('loadController', 'loadListAction'),
                'users' => array('@'),
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
        $model = new SysAction;
        $model->scenario = 'multipleAction';
        $modelList = SysAction::model()->findAllByAttributes(['controller_id' => 0]);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['SysAction'])) {
            $model->attributes = $_POST['SysAction'];

            if (isset($_POST['action_name'])) {
                $listAction = [];
                foreach ($_POST['action_name'] as $index => $action_name) {
                    $list = (object) [];
                    $list->action_id = isset($_POST['action_id'][$index]) ? $_POST['action_id'][$index] : '';
                    $list->action_name = $action_name;
                    $list->action_desc = $_POST['action_desc'][$index];
                    $listAction[] = $list;
                }
                $modelList = $listAction;
            }

            $notExisting = true; //$this->_notExisting($model);

            if ($model->validate() && $notExisting) {
                foreach ($modelList as $list) {
                    if (!empty($list->action_name)) {
                        $m = SysAction::model()->findByPk($list->action_id);
                        if ($m === null) {
                            $m = new SysAction;
                            $m->action_name = $list->action_name;
                            $m->action_desc = $list->action_desc;
                            $m->controller_id = $model->controller_id;
                            $m->save(false);
                        } else {
                            if ($m->action_name != $list->action_name || $m->action_desc != $list->action_desc) {
                                $m->action_name = $list->action_name;
                                $m->action_desc = $list->action_desc;
                                $m->save(false);
                            }
                        }

                        $success = true;
                    }
                }

                if (isset($success) && $success) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Action added successfully.'));
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
            'modelList' => $modelList,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->scenario = 'multipleAction';
        $modelList = SysAction::model()->findAllByAttributes(['controller_id' => $model->controller_id]);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $controllerOld = $model->controller_id;
        if (isset($_POST['SysAction'])) {;
            $model->attributes = $_POST['SysAction'];

            if (isset($_POST['action_name'])) {
                $listAction = [];
                foreach ($_POST['action_name'] as $index => $action_name) {
                    $list = (object) [];
                    $list->action_id = isset($_POST['action_id'][$index]) ? $_POST['action_id'][$index] : '';
                    $list->action_name = $action_name;
                    $list->action_desc = $_POST['action_desc'][$index];
                    $listAction[] = $list;
                }
                $modelList = $listAction;
            }

            $notExisting = true; //$this->_notExisting($model, $id);

            if ($model->validate() && $notExisting) {
                foreach ($modelList as $list) {
                    if (!empty($list->action_name)) {
                        $m = SysAction::model()->findByPk($list->action_id);
                        if ($m === null) {
                            $m = new SysAction;
                            $m->action_name = $list->action_name;
                            $m->action_desc = $list->action_desc;
                            $m->controller_id = $model->controller_id;
                            $m->save(false);
                        } else {
                            if ($m->action_name != $list->action_name || $m->action_desc != $list->action_desc) {
                                $m->action_name = $list->action_name;
                                $m->action_desc = $list->action_desc;
                                $m->save(false);
                            }
                        }

                        $success = true;
                    }
                }

                if (isset($success) && $success) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Action updated successfully.'));
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
            'modelList' => $modelList,
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
        $dataProvider = new CActiveDataProvider('SysAction');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new SysAction('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['SysAction']))
            $model->attributes = $_GET['SysAction'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SysAction the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = SysAction::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SysAction $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sys-action-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /*     * ****************************
     * added by Saiful on 20150615
     * function load dropdownlist dependending on parent value
     * ***************************** */

    public function actionLoadController() {
        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST["parent"]))
                $parent = $_POST["parent"];
            else
                $parent = "";

            if (isset($_POST["selected"]))
                $selected = $_POST["selected"];
            else
                $selected = "";

            if (isset($_POST["labelEmpty"]))
                $labelEmpty = $_POST["labelEmpty"];
            else
                $labelEmpty = Yii::t('app', '-- Select --');

            $data = SysController::model()->getControllerList($parent);

            echo CHtml::tag('option', array('value' => '', 'selected' => 'selected'), $labelEmpty, true);
            foreach ($data as $value => $child) {
                $arrValue = array('value' => $value);
                if ($value == $selected)
                    $arrValue = array_merge($arrValue, array('selected' => 'selected'));

                echo CHtml::tag('option', $arrValue, CHtml::encode($child), true);
            }
            Yii::app()->end();
        }
    }

    function _notExisting($oBj, $currectId = '') {
        $condition = array(
            'action_name' => $oBj->action_name,
            'controller_id' => $oBj->controller_id,
        );
        $extra = '';
        if (!empty($currectId)) {
            $extra = array(
                'condition' => 'action_id!=:id',
                'params' => array(':id' => $currectId)
            );
        }
        $modelExist = SysAction::model()->findByAttributes($condition, $extra);
        return (count($modelExist) == 0 ? true : false);
    }

    public function actionDeleteBulk() {
        if (Yii::app()->request->isPostRequest) {

            $response = array();

            $ids = $_POST['ids'];

            if (!empty($ids)) {

                $countRecord = count($ids);
                $successDelete = 0;

                SysRoleAccess::model()->deleteAllByAttributes(array('action_id' => $ids));
                $deleteAction = SysAction::model()->deleteByPk($ids);
                $successDelete = $deleteAction;

                if ($successDelete == $countRecord) {
                    $message = Yii::t('app', 'Action deleted successfully.');
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

    public function actionLoadListAction() {
        if (Yii::app()->request->isPostRequest) {
            $parent = isset($_POST['parent']) ? $_POST['parent'] : '';

            $str = '';

            $model = SysAction::model()->findAllByAttributes(['controller_id' => $parent]);
            foreach ($model as $m) {
                $str .= '<tr class="">'
                        . '<td class="text-center">' . CHtml::checkBox('action_id[]', true, ['value' => $m->action_id, 'class' => 'cls-id']) . '</td>'
                        . '<td>' . CHtml::textField('action_name[]', $m->action_name, ['class' => 'form-control cls-name']) . '</td>'
                        . '<td>' . CHtml::textArea('action_desc[]', $m->action_desc, ['class' => 'form-control cls-autogrow']) . '</td>'
                        . '<td>' . CHtml::linkButton('<span class="glyphicon glyphicon-trash"></span>', ['class' => 'cls-delete btn btn-sm btn-warning']) . '</td>'
                        . '</tr>';
            }

            echo $str;
            Yii::app()->end();
        }
    }

    public function actionDeleteAction() {
        if (Yii::app()->request->isPostRequest) {
            $tableId = isset($_POST['tableId']) ? $_POST['tableId'] : '';
            $rowIndex = isset($_POST['rowIndex']) ? $_POST['rowIndex'] : '';
            $recordId = isset($_POST['recordId']) ? $_POST['recordId'] : '';

            if (!empty($recordId)) {
                SysRoleAccess::model()->deleteAllByAttributes(array('action_id' => $recordId));
                SysAction::model()->deleteByPk($recordId);
            }

            $response = array(
                'tableId' => $tableId,
                'rowIndex' => $rowIndex,
            );

            echo CJSON::encode($response);
            Yii::app()->end();
        }
    }

}
