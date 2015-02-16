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
    public $uses = array('User', 'Translation', 'People','Village');
    public $helpers = array('Session');
    public $components = array('Session');

    public function reports() {
        if (!$this->Session->read('Auth.User')) {
            $this->Session->destroy();
            $this->Cookie->delete('Auth.User');

            $this->redirect('/user/login');
        }
    }

    public function getReportsData() {
        $userID = $this->Session->read('User.user_id');
        $this->autoRender = false;
        $data = $this->Translation->getAllTranslations(true);
        echo json_encode($data);
    }

    public function records() {
        if (!$this->Session->read('Auth.User')) {
            $this->Session->destroy();
            $this->Cookie->delete('Auth.User');

            $this->redirect('/user/login');
        }
        $roleID = $this->Session->read('User.role_id');
        $this->set('roleID', $roleID);
        $operators = $this->User->getOperatorsList();
        $this->set(compact('operators'));
    }

    public function completedrecords() {
        if (!$this->Session->read('Auth.User')) {
            $this->Session->destroy();
            $this->Cookie->delete('Auth.User');

            $this->redirect('/user/login');
        }
    }

    public function getCompletedRecords() {
        $userID = $this->Session->read('User.user_id');
        $roleID = $this->Session->read('User.role_id');
        $_REQUEST['fromdate'] = $_REQUEST['fromdate'] ? $_REQUEST['fromdate'] : '';
        $_REQUEST['todate'] = $_REQUEST['todate'] ? $_REQUEST['todate'] : '';
        $this->autoRender = false;
        $data = $this->People->getCompletedRecords($userID, $roleID, $_REQUEST['fromdate'], $_REQUEST['todate']);
        echo json_encode($data);
    }

    public function getMissingRecords() {
        $userID = $this->Session->read('User.user_id');
        $roleID = $this->Session->read('User.role_id');
        $this->autoRender = false;
        $_REQUEST['userid'] = $_REQUEST['userid'] ? $_REQUEST['userid'] : '';
        $data = $this->People->getMissingData($userID, $roleID, $_REQUEST['userid']);
        echo json_encode($data);
    }

    public function all() {
        $nature_of_business = $this->People->fetchNatureBusniessName();
        $this->set(compact('nature_of_business'));
        
        $specialty_business_service = $this->People->fetchSpecialityBusniessName();
        $this->set(compact('specialty_business_service'));
        
        $businesstypename = $this->People->fetchBusniessTypeName();
        $this->set(compact('businesstypename'));
        
        $businessname = $this->People->fetchBusniessName();
        $this->set(compact('businessname'));
        
         $villages = $this->Village->find('list', array('fields' => array('Village.name', 'Village.name')));
        $this->set(compact('villages'));
        
         $occupation = $this->People-> fetchOccupation();
        $this->set(compact('occupation'));
        
         $date_of_birth = $this->People->fetchDateofBirth();
         $dobs = array();
          foreach ($date_of_birth as $key => $value) {
              $dobs[$value[0]['date_of_birth']] = $value[0]['date_of_birth'];
          }
        // echo '<pre>';print_r($date_of_birth);exit;
        $this->set(compact('dobs'));
       
    }

    public function getAllAjaxData() {
       $userID = $this->Session->read('User.user_id');
        $roleID = $this->Session->read('User.role_id');
        $this->autoRender = false;
       // echo '<pre>';print_r($_REQUEST);exit;
        $_REQUEST['userid'] = $_REQUEST['userid'] ? $_REQUEST['userid'] : '';
        $data = $this->People->getAllData($userID, $roleID, $_REQUEST);
        echo json_encode($data);
    }
}
