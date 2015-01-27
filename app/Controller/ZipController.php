<?php

App::uses('AppController', 'Controller');

Class ZipController extends AppController {

    public $name = 'Zip';
    public $uses = array('ZipCode', 'State');
    public $helpers = array('Session');
    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {        
    }

    public function addZip() {
        
        $this->layout = 'ajax';
        $this->autoRender = false;
        $msg = array();
        $this->request->data['ZipCode']['created'] = date('Y-m-d H:i:s');
        //$this->request->data['Translation']['status'] = 1;
        //print_r($this->request->data);
        $result = $this->ZipCode->checkZipCodeExists($this->request->data['ZipCode']['zip_code']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['ZipCode']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "zip_code";
            $msg['error']['errormsg'][] = __('This name has already been translated.');
        }
        
        $data = $this->request->data;
        if ($msg['status'] == 1) {
            if ($this->ZipCode->save($data)) {
                
                //back update people table
                //$this->People->update('');
                
                $msg['success'] = 1;
                $msg['message'] = 'ZipCode has been saved';
                if ($this->request->data['ZipCode']['id'] != '') {
                    $msg['message'] = 'ZipCode has been updated';
                }
            } else {
                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please try again';
            }
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }

    public function getZipAjaxData() {
        
        $this->autoRender = false;
        header('Content-Type: text/html; charset=utf-8');

        $data = $this->ZipCode->getAllZipCodes();
        echo json_encode($data);
    }

    public function deleteZip() {
        $this->autoRender = false;
        $id = $this->request->data['id'];

        if ($this->ZipCode->delete(array('id' => $id))) {
            $msg['success'] = 1;
            $msg['message'] = 'ZipCode has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }

}
