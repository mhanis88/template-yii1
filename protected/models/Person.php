<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Person
 *
 * @author Saiful
 */
class Person {
    //put your code here    
    public $isNewRecord = false;
    public $primaryKey = 'myid';
    public $myid;
    public $myattr;
 
    public function isAttributeSafe()
    {
        return true;
    }
 
    public function getAttributeLabel()
    {
        return 'Text Field';
    }
    
    public function getScenario() {
    	return 'update';
    }
}
