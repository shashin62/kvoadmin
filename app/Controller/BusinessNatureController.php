<?php
App::uses('AppController', 'Controller');

Class BusinessNatureController extends AppController {
    
    public $name = 'BusinessNature';
    public $uses = array('User','BusinessNature');
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
       
        $this->request->data['BusinessNature']['created'] = date('Y-m-d H:i:s');
        $this->request->data['BusinessNature']['status'] = 1;
        
        $result = $this->BusinessNature->checkBusinessNatureExists($this->request->data['BusinessNature']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['BusinessNature']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This name already exists.');
        }
       
        $data = $this->request->data;
         if ($msg['status'] == 1) {
            if ($this->BusinessNature->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Business Nature has been saved';
                if ($this->request->data['BusinessNature']['id'] != '') {
                    $msg['message'] = 'Business Nature has been updated';
                }
            } else {
                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please try again';
            }
        }
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
        
        
    }

    
    public function getAjaxData()
    {
        $this->autoRender = false;
        $data = $this->BusinessNature->getAllBusinessNatures();
        echo json_encode($data);                                                                                             
    }
    
    public function delete()
    {
         $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->BusinessNature->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Business Nature has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}