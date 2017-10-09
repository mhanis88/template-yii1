<?php

class UserController extends Controller {

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
                'actions' => array('create', 'update', 'admin', 'view', 'deleteBulk', 'gridViewPDF', 'generateGridViewPDF'),
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
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            /* uncomment if want to check duplication */
            /*
              // if checking using id only then uncomment code below
              // $notExisting = $this->_notExisting($model);
              // checking using id with multiple column then uncomment code below
              // $notExisting = $this->_notExisting($model, $model->isNewRecord, ['column_name', 'column_name' => 'value']);
              if (!$notExisting)
              {
              Yii::app()->user->setFlash('error', Yii::t('app', 'Record already exist.'));
              $skip = true;
              }
             */

            $notExistingColumn = $this->_notExisting($model, $model->isNewRecord, 'user_username');
            if (!$notExistingColumn) {
                $model->addError('user_username', Yii::t('app', 'Already exist'));
                $skip = true;
            }

            if (!isset($skip)) {

                if (!empty($_POST['user_password']))
                    $model->user_password = User::model()->cryptPass($_POST['user_password']);
                else
                    $model->user_password = User::model()->cryptPass($model->user_username);

                if ($model->validate()) {

                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('success', Yii::t('app', 'User added successfully.'));
                        $this->redirect(array('admin'));
                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                    }
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

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            /* uncomment if want to check duplication */
            /*
              // if checking using id only then uncomment code below
              // $notExisting = $this->_notExisting($model, $model->isNewRecord);
              // checking using id with multiple column then uncomment code below
              // $notExisting = $this->_notExisting($model, $model->isNewRecord, ['column_name', 'column_name' => 'value']);
              if (!$notExisting)
              {
              Yii::app()->user->setFlash('error', Yii::t('app', 'Record already exist.'));
              $skip = true;
              }
             */

            $notExistingColumn = $this->_notExisting($model, $model->isNewRecord, 'user_username');
            if (!$notExistingColumn) {
                $model->addError('user_username', Yii::t('app', 'Already exist'));
                $skip = true;
            }

            if (!isset($skip)) {

                if (!empty($_POST['user_password']))
                    $model->user_password = User::model()->cryptPass($_POST['user_password']);
            
                if ($model->validate()) {
                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('success', Yii::t('app', 'User updated successfully.'));
                        $this->redirect(array('admin'));
                    } else {
                        Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                    }
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
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        // for record per page
        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
            unset($_GET['pageSize']); // would interfere with pager and repetitive page size change
        }

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
            'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
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
                $deleteAction = User::model()->updateByPk($ids, array('is_delete' => 1, 'update_by' => Yii::app()->user->id, 'update_date' => new CDbExpression('NOW()')));

                /* if use delete completely from database uncomment these */
                // $deleteAction = User::model()->deleteAllByAttributes(array('user_id' => $ids));

                $successDelete = $deleteAction;

                if ($successDelete == $countRecord) {
                    $message = Yii::t('app', 'User deleted successfully.');
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
     * @param boolean $newRecord
     * @param mixed $attr column name in a string or array
     * @return boolean true if not exist else false
     */
    function _notExisting($oBj, $newRecord, $attr = '') {
        $condition = [];
        $extra = '';
        if (!$newRecord) {
            $extra = [
                'condition' => 'user_id!=:id',
                'params' => array(':id' => $oBj->user_id),
            ];
        }


        if (!empty($attr)) {
            if (is_array($attr)) {
                foreach ($attr as $col => $value) {
                    if (is_numeric($col)) {
                        $condition[$value] = $oBj->{$value};
                    } else {
                        $condition[$col] = $value;
                    }
                }
            } else {
                $condition[$attr] = $oBj->{$attr};
            }
        }

        $modelExist = User::model()->findByAttributes($condition, $extra);
        return (count($modelExist) == 0 ? true : false);
    }

    /**
     * Performs url creating for export grid view with current filters in ajax request
     * @return string url
     */
    public function actionGridViewPDF() {
        if (Yii::app()->request->isPostRequest) {
            $arr = [];
            if (isset($_POST['User']))
                $arr = $_POST;

            echo Yii::app()->createUrl(Yii::app()->controller->module->id . '/' . Yii::app()->controller->id . '/generateGridViewPDF', $arr);
            Yii::app()->end();
        }
    }

    public function actionGenerateGridViewPDF() {

        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $mPDF = Yii::app()->ePdf->mpdf();

        $themePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/';
        if (SysThemes::getActiveTheme() > 0):
            $stylesheet = file_get_contents($themePath . SysThemes::getCurrentThemesByParentName() . '/' . SysThemes::getCurrentThemesByName() . '/css/bootstrap.css');
            $mPDF->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
        else:
            $stylesheet = file_get_contents($themePath . 'twitter/css/bootstrap.css');
            $mPDF->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
            $stylesheet = file_get_contents($themePath . 'twitter/css/bootstrap-theme.css');
            $mPDF->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
        endif;

        $mPDF->WriteHTML($this->renderPartial('_gridView', ['model' => $model, 'pdf' => true], true));
        $mPDF->Output('list.pdf', 'D');
    }

}
