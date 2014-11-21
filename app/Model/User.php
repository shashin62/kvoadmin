<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
    var $name = 'User';
    var $belongsTo = array('Role');
    
     /**
     * make the related Acl entry an ARO or an ACO. The default is to create ACOs:
     * @var type 
     */
    public $actsAs = array('Acl' => array('type' => 'requester'));
    
    
    
     /**
     * 
     * @param type $options
     * @return boolean 
     */
    public function beforeSave($options = null) {
        parent::beforeSave($options);

        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
            return true;
        }
    }
    
    public function parentNode() 
    {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['role_id'])) {
            $roleId = $this->data['User']['role_id'];
        } else {
            $roleId = $this->field('role_id');
        }
        if (!$roleId) {
            return null;
        } else {
            return array('Role' => array('id' => $roleId));
        }
    }
/**
     * In case we want simplified per-group only permissions, we need to implement bindNode() in User model. 
     * @param type $user
     * @return type 
     */
    public function bindNode($user) {
        return array('model' => 'Role', 'foreign_key' => $user['User']['role_id']);
    }
    
    public function getEmailUserData($email, $checkActive = true, $checkPass = '') {
        
         $this->recursive = -1;
        $options['conditions']['User.username'] = $email;
       
            $options['conditions']['User.password'] = $checkPass;
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
?>