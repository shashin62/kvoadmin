<?php

App::uses('AppController', 'Controller');

Class TranslationController extends AppController {
    
     public $name = 'Translation';
    public $uses = array('Translation','State');
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
       
        $this->request->data['Translation']['created'] = date('Y-m-d H:i:s');
        $this->request->data['Translation']['status'] = 1;
        $data = $this->request->data;
         if ($this->Translation->save($data) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Your Information has been saved';
            if ($this->request->data['Translation']['id'] != '') {
                $msg['message'] = 'Translation has been updated';
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
        
        
        $data = $this->Translation->getAllTranslations();
        echo json_encode($data);
    }
    
    public function delete()
    {
         $this->autoRender = false;
        $id = $_REQUEST['id'];    
        
        if ($this->Translation->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'Translation has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}
    

