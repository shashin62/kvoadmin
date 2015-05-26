<?php


App::uses('AppController', 'Controller');

Class SurnameController extends AppController {
    
     public $name = 'Surname';
    public $uses = array('User','Surname');
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
       
        $this->request->data['Surname']['created'] = date('Y-m-d H:i:s');
        $this->request->data['Surname']['status'] = 1;
        
        $result = $this->Surname->checkSurnameExists($this->request->data['Surname']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['Surname']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This Surname already exists.');
        }
        
        $data = $this->request->data;
        if ($msg['status'] == 1) {
            if ($this->Surname->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Surname has been saved';
                if ($this->request->data['Surname']['id'] != '') {
                    $msg['message'] = 'Surname has been updated';
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
        $this->layout = 'ajax';
        $this->autoRender = false;
        
        
        $data = $this->Surname->getAllSurnames();
        echo json_encode($data);
        exit;
    }
    
    public function delete()
    {
        $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->Surname->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Surname has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}
