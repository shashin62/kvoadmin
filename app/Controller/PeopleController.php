<?php

/**
 * Controller file
 *
 * PHP version 5.5
 *
 * @category  Controller
 * @package   KVO Admin
 * @author    S
 * @copyright 2014 KVO Admin
 * @version   GIT:$
 * @since     1.0
 */
App::uses('AppController', 'Controller');

/**
 * Controller class for People Controller
 * 
 * @category  Controiller
 * @package   KVO Admin
 * @author    S
 * @copyright 2014 KVO Admin
 * @since     1.0
 */
Class PeopleController extends AppController {
    /**
     *
     * @var type 
     */
    public $name = 'People';

    /**
     *
     * @var array 
     */
    public $uses = array('User','People', 'Village', 'Education', 'State', 'BloodGroup', 'Group','Address');

    /**
     *
     * @var type 
     */
    public $helpers = array('Session');
    /**
     *
     * @var type 
     */
    public $components = array('Session');
    
    public function search()
    {
        $villages = $this->Village->find('list', array('fields' => array('Village.name', 'Village.name')));
        $this->set(compact('villages'));
    }
    
    public function callAgain()
    {
         $userID = $this->Session->read('User.user_id');
        $this->autoRender = false;
        $data = $this->People->getCallAgainMembers($userID);
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        exit;
        echo json_encode($data);
    }
}

