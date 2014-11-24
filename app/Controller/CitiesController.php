<?php
App::uses('AppController', 'Controller');
class CitiesController extends AppController {
    
    
    public $components = array('DataTable');
    public $uses = array('City');


    public function index()
    {
        if($this->RequestHandler->responseType() == 'json') {
            $this->paginate = array(
                'fields' => array('id', 'name', 'population'),
                'link' => array(
                    'State' => array(
                        'fields' => array('id','name','abbrev')
                    )
                )
            );
            $this->DataTable->mDataProp = true;
            $this->set('response', $this->DataTable->getResponse());
            $this->set('_serialize','response');
        }
    }
    
    public function getAjaxData()
    {
        $this->autoRender = false;
        
        $city = new City();
        $data = $city->getCities();
        echo json_encode($data);
        
        
    }
    public function deleteCity()
    {
        
        $this->autoRender = false;
        $id = $_REQUEST['id'];
        $city = new City();
        
        $city->delete(array('id' =>$id));
        
        
    }

    public function containable(){
        if($this->RequestHandler->responseType() == 'json') {
            $this->paginate = array(
                'fields' => array('id', 'name', 'population'),
                'contain' => array(
                    'State' => array(
                        'fields' => array('id','name','abbrev')
                    )
                )
            );
            
            $this->DataTable->mDataProp = true;
            $this->set('response', $this->DataTable->getResponse());
            $this->set('_serialize','response');
        }
    }
    
    public function concat(){
        if($this->RequestHandler->responseType() == 'json') {
            $this->paginate = array(
                'fields' => array('City.id', 'CONCAT(City.name," / ",City.population) as together'),
                'link' => array(
                    'State' => array(
                        'fields' => array('id','name','abbrev')
                    )
                )
            );
            
            $this->DataTable->mDataProp = true;
            $this->set('response', $this->DataTable->getResponse());
            $this->set('_serialize','response');
        }
    }
    
    public function virtualFields(){
        if($this->RequestHandler->responseType() == 'json') {
            
            $this->City->virtualFields = array(
                'together' => 'CONCAT(City.name," / ",City.population)'
            );
            
            $this->paginate = array(
                'fields' => array('id','together','population'),
                'link' => array(
                    'State' => array(
                        'fields' => array('id','name','abbrev')
                    )
                )
            );
            
            $this->DataTable->mDataProp = true;
            $this->set('response', $this->DataTable->getResponse());
            $this->set('_serialize','response');
        }
    }
    
    public function noJsonHandler(){
        if($this->request->is('ajax')){
            $this->autoRender = false;
            $this->paginate = array(
                'fields' => array('id', 'name', 'population'),
                'link' => array(
                    'State' => array(
                        'fields' => array('name')
                    )
                )
            );

            $this->DataTable->mDataProp = true;
            echo json_encode($this->DataTable->getResponse());
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

