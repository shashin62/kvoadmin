<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

Class People extends AppModel
{
    public $name = 'People';
    
    public function getAllPeoples($type = false)
    {
        
        $aColumns = array('p.id','p.first_name','p.last_name', 'p.village','p.mobile_number','p.m_id','p.f_id',
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
        
        $aSearchCollumns = array('p.id','p.first_name','p.last_name','p.mobile_number','DATE_FORMAT(p.date_of_birth,   "%m/%d/%Y"  )','p.village','p.father','p.mother');
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
                    $sWhere .= ' p.gender = "male" AND p.first_name is not null';
                    break;
                case 'addmother':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.gender = "female"  AND p.first_name is not null';
                    break;
                case 'addchilld':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' (p.gender = "female" OR p.gender = "male")  AND p.first_name is not null';
                    break;
                case 'addspouse':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' (p.gender = "female" )  AND p.first_name is not null';
                    break;
                case 'global' :
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.first_name is not null';
                    break;
                default:
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.gender = "male"  AND p.first_name is not null';
                    break;
            }
        } else {
            
        }
//cho $sWhere;exit;
        /*
         * SQL queries
         * Get data to display
         */
        $sJoin = "  LEFT JOIN people as parent ON (parent.id = p.f_id)
                    LEFT JOIN people as parent2 ON (parent2.id = p.m_id) 
                    LEFT JOIN people AS parent3 ON parent3.id = parent.f_id
                    LEFT JOIN people as parent4 ON parent4.id = parent2.f_id
                    ";
                    
        //$sGroup = " group by p.mobile_number";

      $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS p.id, p.first_name, p.last_name,p.village,p.mobile_number,p.date_of_birth, p.m_id, p.f_id, 
    IF( p.f_id = parent.id ,parent.first_name, '') as father
              , IF( p.m_id = parent2.id, parent2.first_name, '') as mother
              , p.partner_name as spouse
              , p.maiden_village as maiden_village
              , p.maiden_surname as maiden_surname
              , concat_ws(' ',parent3.first_name,parent3.last_name) as grandfather,
              concat_ws(' ',parent4.first_name,parent4.last_name) as grandfather_mother,
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

      //// echo '<pre>';
      //  print_r($rResult);
      //  exit;
        foreach ($rResult as $key => $value) {

            $row = array();
            //for ($i = 0; $i < count($aColumns); $i++) {
                /* General output */
            //if( $type != 'global') {
                $row[] = '';
            //}
            foreach ( $value['p'] as $k => $v) {
               
                if ($k  == 'date_of_birth' && $v != '0000-00-00 00:00:00') {
                     $row[] = date("d/m/Y", strtotime($v));
                } else if ($k  == 'date_of_birth' && $v == '0000-00-00 00:00:00'){
                    $row[] = '-';
                 }  else {
                     $row[] = $v;
                }
            }
            $row[] = $value[0]['date_of_birth'];
            foreach ( $value[0] as $kP => $parents) {
                if ($kP  != 'date_of_birth') {
                    $row[] = $value[0][$kP];
                }
                
            }
            $row[] = '';
            $output['aaData'][] = $row;
        }
        //echo '<pre>';
      //  print_r($output);
      //  exit;
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
           // $options['conditions']['People.group_id'] = $groupId;
        }
        $options['fields'] = array('concat(People.first_name,"  ",People.last_name) as childname','People.id');
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


    public function getPeopleData( $userId , $type = false , $groupId = false) {
        $this->recursive = -1;
        if( $type) {
            $options['conditions']['People.id'] = $userId;
        } else {
            $options['conditions']['People.user_id'] = $userId;
        }
        
        $options['conditions']['Group.group_id'] = $groupId;
        
         $options['joins'] = array(
            array('table' => 'people_groups',
                'alias' => 'Group',
                'type' => 'INNER',
                'conditions' => array(
                    'People.id = Group.people_id'
                )
            )
             );
        
          $options['fields'] = array('People.*','Group.tree_level');
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
    public function getFamilyDetails($groupId , $pid = false,$getAllDetails = false, $flag = false)
    {
        
        $this->recursive = -1;
        $options['conditions']['Group.group_id'] = $groupId;
        
        if( $pid ) {
            $options['conditions']['People.id'] = $pid;
        }
        if( $getAllDetails) {
             $options['joins'] = array(
            array('table' => 'people_groups',
                'alias' => 'Group',
                'type' => 'LEFT',
                'conditions' => array(
                    'People.id = Group.people_id'
                )
            ),
             array('table' => 'people',
                'alias' => 'parent1',
                'type' => 'LEFT',
                'conditions' => array(
                    'parent1.id = People.f_id'
                )
            ),
             array('table' => 'people',
                'alias' => 'parent2',
                'type' => 'LEFT',
                'conditions' => array(
                    'parent2.id = People.m_id'
                )
            ),
             
             array('table' => 'people',
                'alias' => 'grandfather',
                'type' => 'LEFT',
                'conditions' => array(
                    'grandfather.id = parent1.f_id'
                )
            ),
              array('table' => 'people',
                'alias' => 'grandfatherm',
                'type' => 'LEFT',
                'conditions' => array(
                    'grandfatherm.id = parent2.f_id'
                )
            ),
 
                  array('table' => 'address',
                'alias' => 'Address',
                'type' => 'LEFT',
                'conditions' => array(
                    'Address.people_id = People.id'
                )
            )
             );
        } else {
             $options['joins'] = array(
            array('table' => 'people_groups',
                'alias' => 'Group',
                'type' => 'LEFT',
                'conditions' => array(
                    'People.id = Group.people_id'
                )
            ),
	 array('table' => 'spouses',
		        'alias' => 'exspouse',
		        'type' => 'LEFT',
		        'conditions' => array(
		            'exspouse.people_id = People.id'
		        )
		    )
                 );
        }
        if ( $getAllDetails) {
            $options['fields'] = array('People.*','Group.tree_level','Group.people_id',
                'concat_ws(" ",grandfather.first_name,grandfather.last_name) as grandfather',
                'concat_ws(" ",grandfatherm.first_name,grandfatherm.last_name) as grandfather_mother',
                'Address.phone1'
                );
        } else {
            $options['fields'] = array('People.*','Group.tree_level','Group.people_id','group_concat(exspouse.spouse_id) as exspouses');
            if ( $flag) {
                //$options['fields'][] = array('secondary as secondary');
            }
        }
          
          $options['order'] = array('Group.tree_level' => 'asc');
          $options['group'] = array('People.id');
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
    
    public function updateAfterDeletion($id)
    {
        $this->recursive = -1;

       $query = "UPDATE {$this->tablePrefix}people
                  SET partner_id = '', partner_name = ''            
                  WHERE partner_id = {$id}";
        $update = "UPDATE {$this->tablePrefix}people
                  SET f_id = '', father = ''            
                  WHERE f_id = {$id}";
        $updateMother = "UPDATE {$this->tablePrefix}people
                  SET m_id = '', mother = ''            
                  WHERE m_id = {$id}";
                  
        try {
            $this->query($query);
            $this->query($update);
            $this->query($updateMother);
                    
            return true;
        } catch (ErrorException $e) {
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
                      , nature_of_business = '{$data['nature_of_business']}', specialty_business_service = '{$data['specialty_business_service']}'     
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
        $options['conditions'] = array('People.mobile_number' => $phone);
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
            
        }
        
        $options['joins'] = array(
            array('table' => 'groups',
                'alias' => 'Group',
                'type' => 'INNER',
                'conditions' => array(
                    'People.group_id = Group.id'
                )
            ),
             );
        
        
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
       $options['conditions']['AND'] = array('pgroup.tree_level' => '');
        if( !empty($data['first_name'])) {
            $options['conditions']['AND'][] = array('People.first_name' => $data['first_name']);
        }
        
        if( !empty($data['last_name'])) {
            $options['conditions']['AND'][] = array('People.last_name' => $data['last_name']);
        }
        if( !empty($data['village'])) {
            $options['conditions']['AND'][] = array('People.village' => $data['village']);
        }
        
        if( !empty($data['mobile_number'])) {
            $options['conditions']['AND'][] = array('People.mobile_number' => $data['mobile_number']);
        }
        
        if( !empty($data['email'])) {
            $options['conditions']['AND'][] = array('People.email' => $data['email']);
        }
        
        $options['joins'] = array(
            array('table' => 'people_groups',
                'alias' => 'pgroup',
                'type' => 'INNER',
                'conditions' => array(
                    'People.id = pgroup.people_id'
                )
            ),
             );
        
       
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
    
    public function getAllRelationsIds($peopleId) 
    {
        $this->recursive = -1;
        
        $options['conditions']['AND'] = array('People.id' => $peopleId);
        
        $options['fields'] = array('People.partner_id','People.f_id','People.m_id');
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
    
    public function getCallAgainMembers()
    {
        $aColumns = array('id', 'first_name', 'last_name','mobile_number');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "people";

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
                    $sOrder .= "`" . $aColumns[intval($_GET['iSortCol_' . $i])] . "` " .
                            ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }
        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . ($_GET['sSearch']) . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }
        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= "`" . $aColumns[$i] . "` LIKE '%" . ($_GET['sSearch_' . $i]) . "%' ";
            }
        }
        
        if ($sWhere == "") {
            $sWhere = "WHERE call_again = 1";
        } else {
            $sWhere .= ' AND call_again = 1';
        }

        /*
         * SQL queries
         * Get data to display
         */


        $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS `" . str_replace(" , ", " ", implode("`, `", $aColumns)) . "`
            FROM   $sTable
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
    SELECT COUNT(`" . $sIndexColumn . "`) as countid
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
            for ($i = 0; $i < count($aColumns); $i++) {
                /* General output */
                $row[] = $value['people'][$aColumns[$i]];
            }
            //$row[] = '';
            $output['aaData'][] = $row;
        }
        return $output;
    }
    
    public function getCompletedCountLastWeek($userId)
    {
        $this->recursive = -1;
        $dbh = $this->getDataSource();
        
        $result = $dbh->fetchAll("SELECT 
SUM(IF(p.f_id IS NOT NULL AND p.m_id IS NOT NULL AND p.gender IS NOT NULL AND p.village IS NOT NULL AND p.date_of_birth IS NOT NULL AND p.mobile_number IS NOT NULL,1,0)) as count, u.first_name, u.last_name,p.modified,GROUP_CONCAT(p.id)
FROM `people` as p
INNER JOIN users as u ON u.id = p.created_by
WHERE u.role_id = 2  or u.role_id =1 AND p.is_late = 0 
 AND p.modified BETWEEN DATE_SUB( CURDATE( ) , INTERVAL (dayofweek(CURDATE())+5) DAY ) AND DATE_SUB( CURDATE( ) , INTERVAL (dayofweek(CURDATE())) DAY ) 
GROUP BY p.created_by");
        
        return $result;
        
    }
    
    public function getCompletedCountThisWeek($userId) 
    {
        $this->recursive = -1;
        $dbh = $this->getDataSource();
        
        $result = $dbh->fetchAll("SELECT 
SUM(IF(p.f_id IS NOT NULL AND p.m_id IS NOT NULL AND p.gender IS NOT NULL AND p.village IS NOT NULL AND p.date_of_birth IS NOT NULL AND p.mobile_number IS NOT NULL,1,0)) as count, u.first_name, u.last_name,p.modified
FROM `people` as p
INNER JOIN users as u ON u.id = p.created_by

WHERE u.role_id = 2 or u.role_id =1 AND p.is_late = 0 
AND YEARWEEK(p.modified )=YEARWEEK(NOW())
GROUP BY p.created_by");
        
        return $result;

        try {
            
            return $result;
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        } 
    }
    
    public function getInCompleteRecords()
    {
        $this->recursive = -1;
        $dbh = $this->getDataSource();
        
        $result = $dbh->fetchAll("SELECT 
SUM(IF(p.f_id IS  NULL OR p.m_id IS  NULL OR p.gender IS  NULL OR p.village IS  NULL OR p.date_of_birth IS  NULL OR p.mobile_number IS NOT NULL,1,0)) as count, u.first_name, u.last_name,p.modified
FROM `people` as p
INNER JOIN users as u ON u.id = p.created_by

WHERE u.role_id = 2 or u.role_id =1 AND p.is_late = 0 

GROUP BY p.created_by");
        
        return $result;

        try {
            
            return $result;
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        } 
    }
    
    public function getAutoCompleteFirstName($term) {
         $this->recursive = -1;
        
        $options['conditions'] = array('People.first_name like' => '%'.$term.'%');
        
        $options['fields'] = array('People.first_name','People.id');
        $options['group']  = array('People.first_name');
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
    
    
    public function getAutoCompleteLastName($term) {
         $this->recursive = -1;
        
        $options['conditions'] = array('People.last_name like' => '%'.$term.'%');
        
        $options['fields'] = array('People.last_name','People.id');
        $options['group']  = array('People.last_name');
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
    
    public function getSpecialBusinessData($term) {
         $this->recursive = -1;
        
        $options['conditions'] = array('People.specialty_business_service like' => '%' . $term . '%');
        $options['fields'] = array('People.specialty_business_service', 'People.id');

        $options['group'] = array('People.specialty_business_service');
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
    
    public function getTypeBusinessData($term) {
         $this->recursive = -1;
        
        $options['conditions'] = array('People.business_name like' => '%' . $term . '%');
        $options['fields'] = array('People.business_name', 'People.id');

        $options['group'] = array('People.business_name');
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
    
    public function getNatureBusinessData($term) {
         $this->recursive = -1;
        
        $options['conditions'] = array('People.nature_of_business like' => '%' . $term . '%');
        $options['fields'] = array('People.nature_of_business', 'People.id');

        $options['group'] = array('People.nature_of_business');
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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

