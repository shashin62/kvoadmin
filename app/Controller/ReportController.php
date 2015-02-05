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
    public $uses = array('User', 'Translation', 'People');
    public $helpers = array('Session');
    public $components = array('Session');

    public function reports() {
        
    }

    public function getReportsData() {
        $userID = $this->Session->read('User.user_id');
        $this->autoRender = false;
        $data = $this->Translation->getAllTranslations(true);
        echo json_encode($data);
    }

    public function records() {
        $roleID = $this->Session->read('User.role_id');
        $this->set('roleID',$roleID);
       $operators =   $this->User->getOperatorsList();
         $this->set(compact('operators'));
    }
    
    public function completedrecords() {
          $userID = $this->Session->read('User.user_id');
        $roleID = $this->Session->read('User.role_id');
       $fromdate = $_REQUEST['fromdate'];
	   $todate = $_REQUEST['todate'];
	    if ($this->request->is('post')) {
		
		$data = $this->People->getCompletedRecords($userID, $roleID, $fromdate,  $todate );
		$this->set('fromdate', $fromdate);
		$this->set('todate', $todate);
		} else {
			$this->set('fromdate', '');
		$this->set('todate', '');
		$data = $this->People->getCompletedRecords($userID, $roleID);
		}
		
       
		$this->set('count', $data['completedrecords']);
		
    }
    public function getMissingRecords() {
        $userID = $this->Session->read('User.user_id');
        $roleID = $this->Session->read('User.role_id');
        $this->autoRender = false;
         $_REQUEST['userid'] = $_REQUEST['userid'] ? $_REQUEST['userid'] : '';
        $data = $this->People->getMissingData($userID, $roleID, $_REQUEST['userid']);
        echo json_encode($data);
    }
    
    public function getCompletedRecords() {
         $userID = $this->Session->read('User.user_id');
        $roleID = $this->Session->read('User.role_id');
        $this->autoRender = false;
        $data = $this->People->getCompletedRecords($userID, $roleID);
        echo json_encode($data);
    }

}
