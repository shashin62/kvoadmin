<?php


App::uses('AppController', 'Controller');

Class VillageController extends AppController {
    
     public $name = 'Village';
    public $uses = array('User','Village');
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
       
        $this->request->data['Village']['created'] = date('Y-m-d H:i:s');
        $this->request->data['Village']['status'] = 1;
        
        $result = $this->Village->checkVillageExists($this->request->data['Village']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['Village']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This village already exists.');
        }
        
        $data = $this->request->data;
        if ($msg['status'] == 1) {
            if ($this->Village->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Village has been saved';
                if ($this->request->data['Village']['id'] != '') {
                    $msg['message'] = 'Village has been updated';
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
        
        
        $data = $this->Village->getAllVillages();
        echo json_encode($data);
    }
    
    public function delete()
    {
        $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->Village->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Village has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}
