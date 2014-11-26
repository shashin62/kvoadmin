<?php


App::uses('AppController', 'Controller');

Class BloodGroupController extends AppController {
    
     public $name = 'BloodGroup';
    public $uses = array('User','BloodGroup');
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
        
        
        $data = $this->BloodGroup->getAllBloodGroups();
        echo json_encode($data);
    }
    
    public function delete()
    {
        
    }
    
}
