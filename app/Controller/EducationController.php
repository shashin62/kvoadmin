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
    
    public function getAjaxData()
    {
        $this->autoRender = false;
        
        
        $data = $this->Education->getAllEducations();
        echo json_encode($data);
    }
    
    public function delete()
    {
        
    }
    
}
