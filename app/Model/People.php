<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

Class People extends AppModel
{
    public $name = 'People';
    
    public function getPeopleData( $userId) {
        $this->recursive = -1;
        

        $options['conditions']['People.user_id'] = $userId;
        
          $options['fields'] = array('People.*');
        try {
            $userData = $this->find('all', $options);


            if (!empty($userData) && isset($userData[0])) {
                $userData = $userData[0];

                return $userData;
            }

            return false;
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

