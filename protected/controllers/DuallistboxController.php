<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CkeditorController
 *
 * @author Saiful
 */
class DuallistboxController extends Controller  {
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
        
        $model = new SysMenu;
        
        $menuAll = SysMenu::model()->findAll();
        $menuPublish = SysMenu::model()->findAllByAttributes(array('is_publish' => 1));
        
        $this->render('index',array(
            'model' => $model,
            'menuAll' => $menuAll,
            'menuPublish' => $menuPublish,
        ));
    }
}
