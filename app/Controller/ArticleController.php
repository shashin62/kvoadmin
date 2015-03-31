<?php

App::uses('AppController', 'Controller');

Class ArticleController extends AppController {
    
    public $name = 'Article';
    
    public $uses = array('Article');
    
    public $helpers = array('Session');
    
    public $components = array('Session');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {   
        if ($this->request->is('post')) {
            $msg = array();
            $this->request->data['Article']['created'] = date('Y-m-d H:i:s');

            $result = $this->Article->checkArticleExists($this->request->data['Article']['title']);
            $msg['status'] = 1;
            if (!empty($result) && $this->request->data['Article']['id'] == '') {
                $msg['status'] = 0;
                $msg['error']['name'][] = "name";
                $msg['error']['errormsg'][] = __('This Article already exists.');
            }

            $data = $this->request->data;

            if ($this->Article->saveArticle($data)) {
                $msg['success'] = 1;
                $msg['message'] = 'Article has been saved';
                if ($this->request->data['Article']['id'] != '') {
                    $msg['message'] = 'Article has been updated';
                }
            } else {
                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please try again';
            }


            $this->set(compact('msg'));
        }
    }

    public function getArticleAjaxData() {
        
        $this->autoRender = false;
        header('Content-Type: text/html; charset=utf-8');

        $data = $this->Article->getAllArticles();
        echo json_encode($data);
    }
    
    public function getArticleData() {
        $this->autoRender = false;
        header('Content-Type: text/html; charset=utf-8');

        $data = $this->Article->find('all', array(
            'conditions' => array('Article.id' => $_REQUEST['id']))
        );       

        echo json_encode($data[0]['Article']);
    }

    public function deleteArticle() {
        $this->autoRender = false;
        $id = $this->request->data['id'];

        if ($this->Article->delete(array('id' => $id))) {
            $msg['success'] = 1;
            $msg['message'] = 'Article has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
}    