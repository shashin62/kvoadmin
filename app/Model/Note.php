<?php

App::uses('AppModel', 'Model');

class Note extends AppModel {

    var $name = 'Note';

    public function getAllNotes($groupId) {

        $this->recursive = -1;
        $options['conditions'] = array('Note.group_id' => $groupId);
        $options['fields'] = array('Note.*','Group.name');
        $options['joins'] = array(
            array('table' => 'groups',
                'alias' => 'Group',
                'type' => 'INNER',
                'conditions' => array(
                    'Note.group_id = Group.id'
                )
            )
             );
        $options['order'] = array('Note.created DESC');
        try {
            $data = $this->find('all', $options);
            if ($data && isset($data[0]['Note']) && $data[0]['Note'] != "") {
                return $data;
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }

}
