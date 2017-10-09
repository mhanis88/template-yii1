<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$file1 = Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pdf-test.pdf';
$file2 = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pdf-test.pdf';
$file2 = str_replace('\\', '/', $file2);
$file3 = $_SERVER["DOCUMENT_ROOT"] . Yii::app()->baseUrl . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pdf-test.pdf';
// $file3 = str_replace('\\', '/', $file3);
echo '<pre>';
var_dump( $file1 );
var_dump( $file2 );
var_dump( $file3 );
var_dump( file_exists($file1) );
var_dump( file_exists($file2) );
var_dump( file_exists($file3) );
var_dump($_SERVER["DOCUMENT_ROOT"]);
echo Yii::app()->baseUrl;
echo '<pre>';