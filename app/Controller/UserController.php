<?php

App::uses('AppController', 'Controller');

Class UserController extends AppController {

    public $name = 'User';
    public $uses = array('User','Aro','Role');
    public $helpers = array('Session');
    public $components = array('Session');

    public function beforeFilter() {
        parent::beforeFilter();
        // $this->Auth->allow(array('add','logout','rebuildARO'));
    }

    public function rebuildARO() {
        // Build the groups.
        $roles = $this->Role->find('all');
        $aro = new Aro();
        foreach ($roles as $role) {
            $aro->create();
            $aro->save(array(
                // 'alias'=>$group['Group']['name'],
                'foreign_key' => $role['Role']['id'],
                'model' => 'Role',
                'parent_id' => null
            ));
        }

        // Build the users.
        $this->User->recursive = -1;
        $users = $this->User->find('all');

        $i = 0;
        foreach ($users as $user) {
            $aroList[$i++] = array(
                // 'alias' => $user['User']['email'],
                'foreign_key' => $user['User']['id'],
                'model' => 'User',
                'parent_id' => $user['User']['role_id']
            );
        }
        foreach ($aroList as $data) {
            $aro->create();
            $aro->save($data);
        }

        echo "AROs rebuilt!";
        exit;
    }

    public function add() {

        $data = array();
        $data['User']['email'] = 'sanil@shet.com';
        $data['User']['password'] = $this->generatePassword();
        $data['User']['created'] = gmdate("Y-m-d H:i:s");
        $data['User']['modified'] = gmdate("Y-m-d H:i:s");
        $data['User']['role_id'] = 2;
        echo '<pre>';
        print_r($data);
        $this->User->recursive = -1;
        $this->User->save($data);
        var_dump($this->User->save($data['User']));
        echo "User Created";
        exit;
    }

    private function generatePassword($password_length = "8") {
        srand($this->make_seed());

        // get proper alfa from confiugre
        $alfa = Configure::read("passwordAlfa");

        $token = "";

        for ($i = 0; $i < $password_length; $i++) {
            $token .= $alfa[rand(0, strlen($alfa) - 1)];
        }

        return $token;
    }

    /**
     * generate secret string
     * 
     * @return type 
     */
    private function make_seed() {
        list($usec, $sec) = explode(' ', microtime());
        return (float) $sec + ((float) $usec * 100000);
    }
    
    public function welcome()
    {
        
    }
    
    public function register()
    {
        if ($this->request->is('post')) {
           
        }
    }
    
    public function getUsers()
    {
        
    }
    
    public function getUserAjaxData()
    {
        $this->autoRender = false;
        
        
        $data = $this->User->getAllUsers();
        echo json_encode($data);
    }
    
    public function doRegisterUser()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        if( !isset($this->request->data['User']['confirm_password'])) {
            unset($this->request->data['User']['confirm_password']);
        }
        if( !isset($this->request->data['User']['role_id'])) {
            $this->request->data['User']['role_id'] = 1;
        }
        if ( !isset($this->request->data['User']['status'])) {
            $this->request->data['User']['status'] = 1;
        }
        if (isset($this->request->data['User']['id']) && $this->request->data['User']['id'] != '') {
            unset($this->request->data['User']['password']);
        }
        $data = $this->request->data;
        $msg['status'] = 1;
        $result = $this->User->checkEmailExists($this->request->data['User']['email']);
       
        if (!empty($result) && $this->request->data['User']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "email";
            $msg['error']['errormsg'][] = __('This Email already exists.');
        }
        
         $phoneData = $this->User->checkPhoneExists($this->request->data['User']['phone_number']);
       
        if (!empty($phoneData) && $this->request->data['User']['id'] == '') {
            $msg['status'] = 0;
            $msg['error']['name'][] = "phone_number";
            $msg['error']['errormsg'][] = __('This Phone already exists.');
        }

        $this->User->recursive = -1;
        if ($msg['status'] == 1) {
            if ($this->User->save($data)) {
              
                $msg['success'] = 1;
                $msg['message'] = 'Your Information has been saved';
                  if ($this->request->data['User']['id'] != '') {
                $msg['message'] = 'user has been updated';
            }
            } else {

                $msg['success'] = 0;
                $msg['message'] = 'System Error, Please trye again';
            }
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
        
    }

    public function login() {

        if ($this->request->is('post')) {

            if ($this->User->validates()) {

                $userAllData = $this->User->getEmailUserData($this->request->data['User']['email'], '', trim(Security::hash(Configure::read('Security.salt') . $this->request->data['User']['password'])));

                if ($this->Auth->login($userAllData['User'])) {
                    $cookie['email'] = $userAllData['User']['email'];
                    $cookie['password'] = $userAllData['User']['password'];

                    $this->Cookie->write('Auth.User', $cookie, true, '+2 weeks');
                    $this->redirect($this->Auth->redirect());
                }
                
                $this->Session->setFlash(__('Invalid username or password, try again'), 'default', array(), 'authlogin');
            }
        }
    }

    public function logout() {
      
        $this->Session->destroy();
        $this->Cookie->delete('Auth.User');

        $this->redirect('/user/login');
    }
    
    public function delete()
    {
        $this->autoRender = false;
        $id = $_REQUEST['id'];    
        $this->User->recursive = -1;
        if ($this->User->delete(array('id' =>$id)) ) {
            $msg['success'] = 1;
            $msg['message'] = 'User has been deleted';
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

