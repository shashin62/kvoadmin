<?php

App::uses('AppController', 'Controller');

Class SuburbController extends AppController {
    
    
    public $name = 'Suburb';
    public $uses = array('User','Suburb');
    public $helpers = array('Session');
    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
    }
     public function add()
    {
       $this->layout = 'ajax';
        $this->autoRender = false;
       
        $this->request->data['Suburb']['created'] = date('Y-m-d H:i:s');
        $this->request->data['Suburb']['status'] = 1;
        
        $result = $this->Suburb->checkSuburbExists($this->request->data['Suburb']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['Suburb']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This Suburb already exists.');
        }
        
        $data = $this->request->data;
        if ($msg['status'] == 1) {
            if ($this->Suburb->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Suburb has been saved';
                if ($this->request->data['Suburb']['id'] != '') {
                    $msg['message'] = 'Suburb has been updated';
                }
            } else {
                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please try again';
            }
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
        
        
    }
    
    public function delete()
    {
        $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->Suburb->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Suburb has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
    
    public function index()
    {
        
        
    }
     public function getAjaxData()
    {
        $this->autoRender = false;
        
        
        $data = $this->Suburb->getAllSuburbs();
        echo json_encode($data);
    }
}

