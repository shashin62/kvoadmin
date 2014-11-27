<?php

App::uses('AppController', 'Controller');

Class BloodGroupController extends AppController {
    
    public $name = 'BloodGroup';
    public $uses = array('User','BloodGroup');
    public $helpers = array('Session');
    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index()
    {
        
    }
    
    public function add()
    {
       $this->layout = 'ajax';
        $this->autoRender = false;
       
        $this->request->data['BloodGroup']['created'] = date('Y-m-d H:i:s');
        $this->request->data['BloodGroup']['status'] = 1;
        $data = $this->request->data;
         if ($this->BloodGroup->save($data) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Your Information has been saved';
            if ($this->request->data['BloodGroup']['id'] != '') {
                $msg['message'] = 'Blood group has been updated';
            }
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
        
        
    }

    public function getAjaxData()
    {
        $this->autoRender = false;
        $data = $this->BloodGroup->getAllBloodGroups();
        echo json_encode($data);
    }
    
    public function delete()
    {
        $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->BloodGroup->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Blood Group has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}
