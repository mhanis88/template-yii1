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
class ThumbnailController extends Controller {

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

    public function actionIndex() {

        $model = new TmpThumbnail;

        if (isset($_POST['TmpThumbnail'])) {
            $pathFile = Yii::app()->params['fileUploadDir'] . DIRECTORY_SEPARATOR;

            $model->attributes = $_POST['TmpThumbnail'];
            $model->picture_ori = CUploadedFile::getInstance($model, 'picture_ori');

//            echo '<pre>';
//            var_dump($model->picture_ori->name);
//            var_dump($model->picture_ori->tempName);
//            var_dump($model->picture_ori->extensionName);
//            echo '</pre>';

            if ($model->validate()) {
                $ext = $model->picture_ori->extensionName;
                $name = $model->picture_ori->name;

                $file = $pathFile . $name;
                if (file_exists($file)) {
                    $name = str_replace(".{$ext}", "-". strtotime('now') . ".{$ext}", $name);
                    $file = $pathFile . $name;
                }
                $tb_name = "tb-{$name}";
                $model->picture_ori->saveAs($file);

                $thumbnail = $pathFile . $tb_name;
                $image = Yii::app()->image->load($file);
                $image->resize(200, 100, Image::AUTO)->sharpen(20);
                $image->save($thumbnail); // or $image->save('images/small.jpg');

                $model->picture_ori = $name;
                $model->picture_tb = $tb_name;
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', Yii::t('app', 'Success.'));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t('app', 'Error.'));
                }
            }
        }

        $modelThumbnail = TmpThumbnail::model()->findAll();

        $this->render('index', array(
            'model' => $model,
            'modelThumbnail' => $modelThumbnail,
        ));
    }

}
