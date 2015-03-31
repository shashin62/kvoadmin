<?php

App::uses('AppController', 'Controller');

Class PollController extends AppController {
    
    public $name = 'Poll';
    
    public $uses = array('Poll');
    
    public $helpers = array('Session');
    
    public $components = array('Session');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {        
    }

    public function addPoll() {
        
        $this->layout = 'ajax';
        $this->autoRender = false;
        $msg = array();

	$this->request->data['Poll']['status'] = 1;
        $this->request->data['Poll']['created'] = date('Y-m-d H:i:s');
       
        $result = $this->Poll->checkPollExists($this->request->data['Poll']['name']);
        $msg['status'] = 1;
        if (!empty($result) && $this->request->data['Poll']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "name";
            $msg['error']['errormsg'][] = __('This Poll already exists.');
        }
        
        $noAnswers = $this->request->data['Poll']['ans_no'];
        unset($this->request->data['Poll']['ans_no']);
        
        $answers = array();
        
        for ($i = 1; $i <= $noAnswers; $i++) { 
            if ($this->request->data['Poll']['answer_' . $i] != '') {
                $answers[] = $this->request->data['Poll']['answer_' . $i];
                
                unset($this->request->data['Poll']['answer_' . $i]);
            }
        }

        $this->request->data['Poll']['answers'] = serialize($answers);
        
        $data = $this->request->data;
        if ($msg['status'] == 1) {
            if ($this->Poll->save($data)) {                
                $msg['success'] = 1;
                $msg['message'] = 'Poll has been saved';
                if ($this->request->data['Poll']['id'] != '') {
                    $msg['message'] = 'Poll has been updated';
                }
            } else {
                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please try again';
            }
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }

    public function getPollAjaxData() {
        
        $this->autoRender = false;
        header('Content-Type: text/html; charset=utf-8');

        $data = $this->Poll->getAllPolls();
        echo json_encode($data);
    }
    
    public function getPollData() {
        $this->autoRender = false;
        header('Content-Type: text/html; charset=utf-8');

        $data = $this->Poll->find('all', array(
            'conditions' => array('Poll.id' => $_REQUEST['id']))
        );
        $answers = array();
        if ($data[0]['Poll']['answers']) {
            $answers = unserialize($data[0]['Poll']['answers']);
        }

        $fData = array();
        $fData['name'] = $data[0]['Poll']['name'];
        
        $fData['id'] = $data[0]['Poll']['id'];
        $fData['control_type'] = $data[0]['Poll']['control_type'];
        
        $i = 1;
        if (count($answers)) {
            foreach ($answers as $answer) {
                $fData['answer_' . $i] = $answer;
                $i = $i + 1;
            }
        }
        $fData['ans_no'] = $i - 1;
        
        $fData['ans_no'] = ($fData['ans_no'] < 5) ? 5 : $fData['ans_no'];

        echo json_encode($fData);
    }

    public function deletePoll() {
        $this->autoRender = false;
        $id = $this->request->data['id'];

        if ($this->Poll->delete(array('id' => $id))) {
            $msg['success'] = 1;
            $msg['message'] = 'Poll has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}    