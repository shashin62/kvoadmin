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
    
    public function getAjaxData()
    {
        $this->autoRender = false;
        
        
        $data = $this->State->getAllStates();
        echo json_encode($data);
    }
    
    public function delete()
    {
        
    }
    
}
