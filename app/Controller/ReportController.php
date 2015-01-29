<?php

/**
 * Controller file
 *
 * PHP version 5.5
 *
 * @category  Controller
 * @package   KVO Admin
 * @author    S
 * @copyright 2014 KVO Admin
 * @version   GIT:$
 * @since     1.0
 */
App::uses('AppController', 'Controller');

/**
 * Controller class for Report Controller
 * 
 * @category  Controiller
 * @package   KVO Admin
 * @author    S
 * @copyright 2014 KVO Admin
 * @since     1.0
 */
Class ReportController extends AppController {
    
     public $name = 'Report';
    public $uses = array('User','Translation','People');
    public $helpers = array('Session');
    public $components = array('Session');
    
    public function reports()
    {
        
    }
    
    public function getReportsData()
    {
        $this->autoRender = false;
        $data = $this->Translation->getAllTranslations(true);
        echo json_encode($data);
        
    }

public function records()
{


}

public function getMissingRecords() {

        $this->autoRender = false;
        $data = $this->People->getMissingData();
echo json_encode($data);


}
}
