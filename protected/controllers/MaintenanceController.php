<?php

class MaintenanceController extends Controller {
    public function actionIndex() {
        $this->layout = '//layouts/blank';
        $this->render('index');
    }
}
