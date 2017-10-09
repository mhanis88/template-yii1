<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pdfwatermark
 *
 * @author Saiful
 */
class PdfwatermarkController extends Controller {

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
// /*
        $pdf = Yii::app()->pdfFactory->getFPDI(); //other options like above  
        $pdf->setPrintHeader(false);

        //import the template
        // $file = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pdf-test.pdf';
        $file = $_SERVER["DOCUMENT_ROOT"] . Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'Document2.pdf';
        // $file = str_replace('\\', '/', $file);
        $pdf->setSourceFile($file);
        $tplidx = $pdf->importPage(1);
        $pdf->addPage();
        $pdf->useTemplate($tplidx);
        
        //Print centered cell with a text in it
        $pdf->SetFont( 'helvetica', 'B', 19 );
        $pdf->SetTextColor(190,190,190);
        
        $pdf->SetY(-200);
        $pdf->Cell(0, 10, "Not Original Copy", 0, 0, 'C');
        $pdf->SetY(-150);
        $pdf->Cell(0, 10, "Not Original Copy", 0, 0, 'C');
        $pdf->SetY(-100);
        $pdf->Cell(0, 10, "Not Original Copy", 0, 0, 'C');

        $pdf->Output();
// */
        $this->render('index');
    }

}
