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
        
    }
    
}
