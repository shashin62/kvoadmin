<?php
Class Address extends AppModel {
    var $name = "Address";
    public $useTable = 'address';
    
    public function getCity()
    {
        $this->recursive = -1;
        $options['conditions'] = array(
                            'Address.city is not null'
                            );
        $options['fields'] = array('Address.city','Address.city');
        $options['group'] = array('Address.city');
        try {
            $userData = $this->find('list', $options);
            if ($userData) {
                return $userData;
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
     public function getSuburb()
    {
        $this->recursive = -1;
        $options['conditions'] = array(
                            'Address.suburb is not null'
                            );
        $options['fields'] = array('Address.suburb','Address.suburb');
        $options['group'] = array('Address.suburb');
        try {
            $userData = $this->find('list', $options);
            if ($userData) {
                return $userData;
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    public function getStates()
    {
        $this->recursive = -1;
        $options['conditions'] = array(
                            'Address.state is not null'
                            );
        $options['fields'] = array('Address.state','Address.state');
        $options['group'] = array('Address.state');
        try {
            $userData = $this->find('list', $options);
            if ($userData) {
                return $userData;
            } else {
                return array();
            }
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

