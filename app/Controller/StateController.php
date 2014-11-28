<?php


App::uses('AppController', 'Controller');

Class StateController extends AppController {
    
     public $name = 'State';
    public $uses = array('User','State');
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
       
        $this->request->data['State']['created'] = date('Y-m-d H:i:s');
        $this->request->data['State']['status'] = 1;
        $this->request->data['State']['country_id'] = 1;
        $this->request->data['State']['country_name'] = 'India';
        
        $result = $this->State->checkStateExists($this->request->data['State']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['State']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This state already exists.');
        }
        $data = $this->request->data;
        if ($msg['status'] == 1) {
            if ($this->State->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'State has been saved';
                if ($this->request->data['State']['id'] != '') {
                    $msg['message'] = 'State has been updated';
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
        
        
        $data = $this->State->getAllStates();
        echo json_encode($data);
    }
    
    public function delete()
    {
         $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->State->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'State has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}
