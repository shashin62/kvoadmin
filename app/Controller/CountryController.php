<?php


App::uses('AppController', 'Controller');

Class CountryController extends AppController {
    
     public $name = 'Country';
    public $uses = array('User','Country');
    public $helpers = array('Session');
    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function index()
    {
        
    }
    
    public function getAjaxData()
    {
        $this->autoRender = false;
        
        
        $data = $this->Country->getAllCountries();
        echo json_encode($data);
    }
    
    public function delete()
    {
         $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->Country->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Education has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
    public function add()
    {
       $this->layout = 'ajax';
        $this->autoRender = false;
       
        $this->request->data['Country']['created'] = date('Y-m-d H:i:s');
        $this->request->data['Country']['status'] = 1;
        
        $result = $this->Country->checkCountryExists($this->request->data['Country']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['Country']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This name already exists.');
        }
        
        $data = $this->request->data;
         if ($msg['status'] == 1) {
            if ($this->Country->save($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Country has been saved';
                if ($this->request->data['Country']['id'] != '') {
                    $msg['message'] = 'Country has been updated';
                }
            } else {
                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please try again';
            }
        }
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
        
        
    }
    
}
