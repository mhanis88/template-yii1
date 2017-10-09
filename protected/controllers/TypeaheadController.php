<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TypeaheadController
 *
 * @author Saiful
 */
class TypeaheadController extends Controller {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'index' and 'logout' actions
                'actions' => array('index','getOption'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    //put your code here
    public function actionIndex(){
        $model = new TmpType();
        
        if(isset($_POST['TmpType'])){
            $model->attributes = $_POST['TmpType'];
            if ($model->validate()) {
                $exits = TmpType::model()->countByAttributes(array('type_name'=>$model->type_name));
                if ($model->save(false) && $exits==0) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Type inserted successfully.'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Unable to save record.'));
                }
            }
        }
        
        $this->render('index', array('model' => $model));
    }
    
    public function actionGetOption(){
        if (Yii::app()->request->isPostRequest) {
            $q = isset($_POST['q']) ? $_POST['q'] : '';
            // var_dump($q);
            $criteria = new CDbCriteria;
            if(!empty($q)){
                $criteria->compare('type_name', $q, true);
            }
            $criteria->compare('is_active', 1);
            $criteria->compare('is_delete', 0);
            $criteria->group = 'type_name';
            $model = TmpType::model()->findAll($criteria);
            $name = GeneralFunction::getUniqueKey($model, 'type_name');
            echo json_encode($name);
            Yii::app()->end();
        }
    }
}
