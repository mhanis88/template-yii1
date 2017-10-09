<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Select2Controller
 *
 * @author Saiful
 */
class Select2Controller extends Controller  {
    //put your code here

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'index' and 'logout' actions
                'actions' => array('index'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionIndex(){
        $model = new TmpType();
        
        if(isset($_POST['TmpType'])){
            var_dump($_POST);
        }
        /*
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
        */
        
        $this->render('index', array('model' => $model));
    }
}
