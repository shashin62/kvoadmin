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
    
    public function getAjaxData()
    {
        $this->autoRender = false;
        
        
        $data = $this->Village->getAllVillages();
        echo json_encode($data);
    }
    
    public function delete()
    {
        
    }
    
}
