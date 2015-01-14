<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

Class ZipCode extends AppModel
{
      public $name = 'ZipCode';
     
     public $useTable = 'zip_codes';
     
      public function getZipCodesData($term, $data = false) {
         $this->recursive = -1;
        
        $options['conditions'] = array('ZipCode.zip_code like' => '%'.$term.'%');
        $options['fields'] = array('ZipCode.zip_code','ZipCode.id');
        if ($data) {
           $options['conditions'] = array('ZipCode.zip_code' => $term);  
           $options['fields'] = array('ZipCode.zip_code','ZipCode.id','ZipCode.state',
               'ZipCode.city','ZipCode.suburb','ZipCode.zone','ZipCode.std');
        } else {
            $options['group']  = array('ZipCode.zip_code');
        }
        
        
        try {
            $userData = $this->find('all', $options);
            if ($userData && isset($userData[0])) {
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
    
   
     