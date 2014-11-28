<?php

App::uses('AppController', 'Controller');

Class FamilyController extends AppController {
    
    public $name = 'Family';
    public $uses = array('User','Aro','Role','People','Village','Education','State','BloodGroup');
    public $helpers = array('Session');
    public $components = array('Session');
    
    
    public function index()
    {
        $userId = $this->Session->read('User.user_id');
        $villages = $this->Village->find('list',array('fields' => array('Village.name','Village.name')));
        $this->set(compact('villages'));
        
        $educations = $this->Education->find('list',array('fields' => array('Education.name','Education.name')));
        $this->set(compact('educations'));
       
        $states = $this->State->find('list',array('fields' => array('State.name','State.name')));
        $this->set(compact('states'));
        
        $bloodgroups = $this->BloodGroup->find('list',array('fields' => array('BloodGroup.name','BloodGroup.name')));
        $this->set(compact('bloodgroups'));
        
        $sessionData = $this->Session->read('User');
        
        $getPeopleData = $this->People->getPeopleData($userId);
        
        
        $this->set('first_name',$getPeopleData['People']['first_name']);
        $this->set('last_name',$getPeopleData['People']['last_name']);
        $this->set('phone_number',$getPeopleData['People']['phone_number'] ?$getPeopleData['People']['phone_number'] : $sessionData['phone_number'] );
        $this->set('email',$getPeopleData['People']['email']);
        $this->set('gender',$sessionData['gender']);
        $this->set('martial_status',$getPeopleData['People']['martial_status']);
        $this->set('surname_now',$getPeopleData['People']['surname_now']);
        $this->set('surname_dob',$getPeopleData['People']['surname_dob']);
        $this->set('state',$getPeopleData['People']['state']);
        $this->set('education',$getPeopleData['People']['education']);
        $this->set('village',$getPeopleData['People']['village']);
        $this->set('blood_group',$getPeopleData['People']['blood_group']);
        
    }
    
    public function editOwnDetails()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
       $userID = $this->Session->read('User.user_id');
        $data = $this->request->data['People'];
        $checkExistingUser = $this->People->find('all',
                array('fields' => array('People.id'),
                    'conditions' => array('People.user_id' => $userID))
                );
//      echo '<pre>';
//      print_r($checkExistingUser);
        if( count($checkExistingUser)) {
            $this->request->data['People']['id'] = $checkExistingUser[0]['People']['id'];
            if( $this->People->save( $this->request->data) ) {
                $msg['status'] = 1;
            } else {
                $msg['status'] = 0;
            }
        }
        
        if( $msg['status'] == 1) {
            $msg['success'] = 1;
            $msg['message'] = 'User has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
}