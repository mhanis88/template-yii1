<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();


    /*
     * to update session timeout if user still active
     * to set use to log out and prompt their session is timeout
     * saiful 08/09/2015
     */

    protected function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Check only when the user is logged in
        if (!Yii::app()->user->isGuest) {
            
            if(Yii::app()->params['sessionTimeoutSeconds']<=0){
                return true;
            }
            else{
                if (Yii::app()->user->getState('userSessionTimeout') < time()) {
                    // for log purposes
                    // GeneralFunction::insertLog('timeout');

                    // timeout
                    Yii::app()->user->logout();
                    if (Yii::app()->request->isAjaxRequest) {
                        $this->renderPartial('application.views.site.sessionTimeout');
                    } else {
                        $this->redirect(Yii::app()->createUrl('site/sessionTimeout'));
                    }
                } else {
                    Yii::app()->user->setState('userSessionTimeout', time() + Yii::app()->params['sessionTimeoutSeconds']);
                    return true;
                }
            }
            
        } else {
            return true;
        }
    }
}
