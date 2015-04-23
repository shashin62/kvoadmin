<?php
App::uses('AppController', 'Controller');

Class BusinessTypeController extends AppController {
    
    public $name = 'BusinessType';
    public $uses = array('User','BusinessType', 'BusinessNature');
    public $helpers = array('Session');
    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index()
    {
        $businessNatures = $this->BusinessNature->find('list', array('fields' => array('BusinessNature.id', 'BusinessNature.name')));
        $this->set(compact('businessNatures'));
    }
    
    public function add()
    {
       $this->layout = 'ajax';
        $this->autoRender = false;
       
        $this->request->data['BusinessType']['created'] = date('Y-m-d H:i:s');
        $this->request->data['BusinessType']['status'] = 1;
        
        $result = $this->BusinessType->checkBusinessTypeExists($this->request->data['BusinessType']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['BusinessType']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This name already exists.');
        }
       
        $data = $this->request->data;
         if ($msg['status'] == 1) {
            if ($this->BusinessType->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Business Type has been saved';
                if ($this->request->data['BusinessType']['id'] != '') {
                    $msg['message'] = 'Business Type has been updated';
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
        $data = $this->BusinessType->getAllBusinessTypes();
        echo json_encode($data);                                                                                             
    }
    
    public function delete()
    {
         $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->BusinessType->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Business Type has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}