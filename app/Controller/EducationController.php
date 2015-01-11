<?php
App::uses('AppController', 'Controller');

Class EducationController extends AppController {
    
     public $name = 'Education';
    public $uses = array('User','Education');
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
       
        $this->request->data['Education']['created'] = date('Y-m-d H:i:s');
        $this->request->data['Education']['status'] = 1;
        
        $result = $this->Education->checkEducationExists($this->request->data['Education']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['Education']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This name already exists.');
        }
       
        $data = $this->request->data;
         if ($msg['status'] == 1) {
            if ($this-Education->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Education has been saved';
                if ($this->request->data['Education']['id'] != '') {
                    $msg['message'] = 'Education has been updated';
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
        
        
        $data = $this->Education->getAllEducations();
        echo json_encode($data);
    }
    
    public function delete()
    {
         $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->Education->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Education has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}