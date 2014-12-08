<?php

/**
 * Controller file
 *
 * PHP version 5.5
 *
 * @category  Controller
 * @package   Kvo Admin
 * @author    S
 * @copyright 2014 Kvo Admin
 * @version   GIT:$
 * @since     1.0
 */
App::uses('AppController', 'Controller');

/**
 * Controller class for People Controller
 * 
 * @category  Controiller
 * @package   Kvo Admin
 * @author    S
 * @copyright 2014 Kvo Admin
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
}

