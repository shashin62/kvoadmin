<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

Class People extends AppModel
{
    public $name = 'People';
    
    public function getAllPeoples($type = false)
    {
        $aColumns = array('p.id','p.first_name','p.last_name', 'p.phone_number','p.m_id','p.f_id',
            'IF( p.f_id = parent.id, parent.first_name, "") as father',
            'IF( p.m_id = parent2.id, parent2.first_name, "") as mother'
            );

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "p.id";

        /* DB table to use */
        $sTable = "people as p";

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
                    intval($_GET['iDisplayLength']);
        }


        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= "" . $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        
        $aSearchCollumns = array('p.id','p.first_name','p.last_name','p.phone_number','p.date_of_birth');
        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aSearchCollumns); $i++) {
                $sWhere .= "" . $aSearchCollumns[$i] . " LIKE '%" . ($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
        /* Individual column filtering */
        for ($i = 0; $i < count($aSearchCollumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= "" . $aSearchCollumns[$i] . " LIKE '%" . ($_GET['sSearch_' . $i]) . "%' ";
            }
        }
        
        if ($type) {
            switch ($type) {
                case 'addfather':
                     if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= ' AND ';
                }
                $sWhere .= ' p.gender = "male"';
                    break;
                case 'addmother':
                    if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= ' AND ';
                }
                    $sWhere .= ' p.gender = "female"';
                    break;
                default:
                    break;
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sJoin = "  LEFT JOIN people as parent ON (parent.id = p.f_id)
                    LEFT JOIN people as parent2 ON (parent2.id = p.m_id) 
                    ";
                    
        //$sGroup = " group by p.phone_number";

      $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS p.id, p.first_name, p.last_name,p.phone_number, p.date_of_birth, p.m_id, p.f_id, 
    IF( p.f_id = parent.id ,parent.first_name, '') as father
              , IF( p.m_id = parent2.id, parent2.first_name, '') as mother,
              p.village,p.email
            FROM   $sTable
                $sJoin
            $sWhere
               
            $sOrder
            $sLimit
            ";

        $rResult = $this->query($sQuery);

        /* Data set length after filtering */
        $sQuery = "
    SELECT FOUND_ROWS() as total
";
        $rResultFilterTotal = $this->query($sQuery);

        $iFilteredTotal = $rResultFilterTotal[0][0]['total'];

        /* Total data set length */
        $sQuery = "
    SELECT COUNT(" . $sIndexColumn . ") as countid
            FROM   $sTable
            ";
        $rResultTotal = $this->query($sQuery);

        $iTotal = $rResultTotal[0][0]['countid'];
        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

       
        foreach ($rResult as $key => $value) {

            $row = array();
            //for ($i = 0; $i < count($aColumns); $i++) {
                /* General output */
            $row[] = '';
            foreach ( $value['p'] as $k => $v) {
                $row[] = $v;
            }
            foreach ( $value[0] as $kP => $parents) {
                $row[] = $value[0][$kP];
            }
            $row[] = '';
            $output['aaData'][] = $row;
        }
        
        return $output;
        
    }

    public function getChildren($fatherId, $gender = false , $groupId = false)
    {
        $this->recursive = -1;
        if( $gender == 'male') {
            $options['conditions']['People.f_id'] = $fatherId;
        } else {
            $options['conditions']['People.m_id'] = $fatherId;
        }
        
        if( $groupId) {
            $options['conditions']['People.group_id'] = $groupId;
        }
        $options['fields'] = array('concat(People.first_name,People.last_name) as childname','People.id');
        try {
            $userData = $this->find('all', $options);

            if (!empty($userData) && isset($userData[0])) {
                $userData = $userData;

                return $userData;
            }

            return false;
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }


    public function getPeopleData( $userId , $type = false) {
        $this->recursive = -1;
        if( $type) {
            $options['conditions']['People.id'] = $userId;
        } else {
            $options['conditions']['People.user_id'] = $userId;
        }
        
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
    
    /**
     * 
     * @param type $groupId
     * @return boolean
     */
    public function getFamilyDetails($groupId)
    {
        
        $this->recursive = -1;
        $options['conditions']['Group.group_id'] = $groupId;
        
         $options['joins'] = array(
            array('table' => 'people_groups',
                'alias' => 'Group',
                'type' => 'LEFT',
                'conditions' => array(
                    'People.id = Group.people_id'
                )
            ),
             );
          $options['fields'] = array('People.*','Group.tree_level','Group.people_id');
          $options['order'] = array('Group.tree_level' => 'asc');
        try {
            $familyData = $this->find('all', $options);


            if (!empty($familyData) && isset($familyData[0])) {
                $familyData = $familyData;

                return $familyData;
            }

            return false;
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    public function updateSpouseDetails($data) {
        $this->recursive = -1;

       $query = "UPDATE {$this->tablePrefix}people
                  SET partner_id = '{$data['partner_id']}', partner_name = '{$data['partner_name']}'            
                  WHERE id = {$data['id']}";
        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    public function updateFatherDetails($data)
    {
        $this->recursive = -1;

      $query = "UPDATE {$this->tablePrefix}people
                  SET f_id = '{$data['f_id']}' , father = '{$data['father']}'           
                  WHERE id = {$data['id']}";
                  
        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    public function updateBusinessDetails($data)
    {
        $this->recursive = -1;

      $query = "UPDATE {$this->tablePrefix}people
                  SET occupation = '{$data['occupation']}' , business_name = '{$data['business_name']}'           
                  WHERE id = {$data['id']}";
                  
        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    
    
    
    public function updateMotherDetails($data)
    {
        $this->recursive = -1;

      $query = "UPDATE {$this->tablePrefix}people
                  SET m_id = '{$data['m_id']}' , mother = '{$data['mother']}'           
                  WHERE id = {$data['id']}";
                  
        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
     /**
     * Function to check if email exists in People table
     * 
     * @param type $email
     * 
     * @return boolean 
     */
    public function checkEmailExists($email) {
        $this->recursive = -1;
        $options['conditions'] = array('People.email' => $email);
        $options['fields'] = array('People.id');
        try {
            $userData = $this->find('all', $options);
            if ($userData && isset($userData[0]['People']) && $userData[0]['People'] != "") {
                return $userData[0]['People'];
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
      /**
     * Function to check if phone exists in table
     * 
     * @param type $phone
     * 
     * @return boolean 
     */
    public function checkPhoneExists($phone) {
        $this->recursive = -1;
        $options['conditions'] = array('People.phone_number' => $phone);
        $options['fields'] = array('People.id');
        try {
            $userData = $this->find('all', $options);
            if ($userData && isset($userData[0]['People']) && $userData[0]['People'] != "") {
                return $userData[0]['People'];
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    /**
     * 
     * @param type $pid
     */
    public function getParentPeopleDetails($data = array())
    {
        $this->recursive = -1;
        if ( isset($data['gid'])) {
            $options['conditions'] = array('People.group_id' => $data['gid']);
            $options['conditions']['AND'] = array('People.tree_level' => '');
        }
        
        $options['fields'] = array('People.id','People.first_name','People.business_address_id','People.address_id');
        try {
            $userData = $this->find('all', $options);
            if ($userData && isset($userData[0]['People']) && $userData[0]['People'] != "") {
                return $userData[0]['People'];
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    public function checkExistingOwner($data)
    {
        $this->recursive = -1;
       $options['conditions']['AND'] = array('People.tree_level' => '');
        if( !empty($data['first_name'])) {
            $options['conditions']['AND'][] = array('People.first_name' => $data['first_name']);
        }
        
        if( !empty($data['last_name'])) {
            $options['conditions']['AND'][] = array('People.last_name' => $data['last_name']);
        }
        if( !empty($data['village'])) {
            $options['conditions']['AND'][] = array('People.village' => $data['village']);
        }
        
        if( !empty($data['phone_number'])) {
            $options['conditions']['AND'][] = array('People.phone_number' => $data['phone_number']);
        }
        
        if( !empty($data['email'])) {
            $options['conditions']['AND'][] = array('People.email' => $data['email']);
        }
        
        
        $options['fields'] = array('People.*');
        
        try {
            $userData = $this->find('all', $options);
            if ($userData && isset($userData[0]['People']) && $userData[0]['People'] != "") {
                return $userData[0]['People'];
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

