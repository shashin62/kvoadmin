<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');

Class People extends AppModel {

    public $name = 'People';
    
    protected $arrIds = array();

    public function getAllPeoples($type = false) {

        $aColumns = array('p.id', 'p.first_name', 'p.last_name', 'p.village', 'p.mobile_number', 'p.m_id', 'p.f_id',
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
        
        $aSearchCollumns = array('p.id', 'p.first_name', 'p.last_name', 'p.mobile_number', 'DATE_FORMAT(p.date_of_birth,   "%m/%d/%Y"  )', 'p.village', 'p.main_surname','p.father', 'p.mother');
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
                 case 'addbrother':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.gender = "Male" AND p.first_name is not null and p.m_id IS NULL AND p.f_id IS NULL ';
                    break;
                case 'addfather':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.gender = "Male" AND p.first_name is not null';
                    break;
                    case 'addsister':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.gender = "Female"  AND p.first_name is not null and p.m_id IS NULL AND p.f_id IS NULL ';
                    break;
                case 'addmother':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' p.gender = "Female"  AND p.first_name is not null';
                    break;
                case 'addchilld':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' (p.gender = "Female" OR p.gender = "Male")  AND p.first_name is not null';
                    break;
                case 'addspouse':
                    if ($sWhere == "") {
                        $sWhere = "WHERE ";
                    } else {
                        $sWhere .= ' AND ';
                    }
                    $sWhere .= ' (p.gender = "Female" )  AND p.first_name is not null';
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
                    $sWhere .= ' p.gender = "Male"  AND p.first_name is not null';
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
            foreach ($value['p'] as $k => $v) {

                if ($k == 'date_of_birth' && $v != '0000-00-00 00:00:00') {
                    $row[] = date("d/m/Y", strtotime($v));
                } else if ($k == 'date_of_birth' && $v == '0000-00-00 00:00:00') {
                    $row[] = '-';
                } else {
                    $row[] = $v;
                }
            }
            $row[] = $value[0]['date_of_birth'];
            foreach ($value[0] as $kP => $parents) {
                if ($kP != 'date_of_birth') {
                    $row[] = $value[0][$kP];
                }
            }
            $row[] = '';
            $output['aaData'][] = $row;
        }
       // echo '<pre>';
      ////    print_r($output);
      //    exit;
        return $output;
    }
    
    public function getAllData($userID, $roleID, $data) {
         $aColumns = array('p.id', 'p.first_name', 'p.last_name', 'p.village', 'p.mobile_number','p.date_of_birth','p.sect','p.martial_status');
        
//echo '<pre>';
//          print_r($data);
//          exit;
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

        $aSearchCollumns = array('p.id', 'p.first_name', 'p.last_name','p.village','p.mobile_number','p.date_of_birth','p.sect','p.martial_status');
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

        if (isset($data['village']) && is_array($data['village'])) {
            $village = implode("','", $data['village']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.village in ('$village')";
            } else {
                $sWhere .= " AND p.village in ('$village')";
            }
        }
        
         if (isset($data['martial_status']) && is_array($data['martial_status'])) {
            $martial_status = implode("','", $data['martial_status']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.martial_status in ('$martial_status')";
            } else {
                $sWhere .= " AND p.martial_status in ('$martial_status')";
            }
        }
        
         if (isset($data['occupation']) && is_array($data['occupation'])) {
            $occupation = implode("','", $data['occupation']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.occupation in ('$occupation')";
            } else {
                $sWhere .= " AND p.occupation in ('$occupation')";
            }
        }
        
         if (isset($data['gender']) && is_array($data['gender'])) {
            $gender = implode("','", $data['gender']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.gender in ('$gender')";
            } else {
                $sWhere .= " AND p.gender in ('$gender')";
            }
        }
        
        if (isset($data['nature_of_business']) && is_array($data['nature_of_business'])) {
            $nature_of_business = implode("','", $data['nature_of_business']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.nature_of_business in ('$nature_of_business')";
            } else {
                $sWhere .= " AND p.nature_of_business in ('$nature_of_business')";
            }
        }
        
        if (isset($data['typebusniess']) && is_array($data['typebusniess'])) {
            $typebusniess = implode("','", $data['typebusniess']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.business_name in ('$typebusniess')";
            } else {
                $sWhere .= " AND p.business_name in ('$typebusniess')";
            }
        }
        
        if (isset($data['specialbusniess']) && is_array($data['specialbusniess'])) {
            $specialbusniess = implode("','", $data['specialbusniess']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.specialty_business_service in ('$specialbusniess')";
            } else {
                $sWhere .= " AND p.specialty_business_service in ('$specialbusniess')";
            }
        }
        
         if (isset($data['busniessname']) && is_array($data['busniessname'])) {
            $busniessname = implode("','", $data['busniessname']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.name_of_business in ('$busniessname')";
            } else {
                $sWhere .= " AND p.name_of_business  in ('$busniessname')";
            }
        }
        
        if (isset($data['sects']) && is_array($data['sects'])) {
            $sects = implode("','", $data['sects']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.sect in ('$sects')";
            } else {
                $sWhere .= " AND p.sect  in ('$sects')";
            }
        }
        
          if (isset($data['islate']) && is_array($data['islate'])) {
            $islate = implode("','", $data['islate']);
            if ($sWhere == "") {
                $sWhere = "WHERE p.is_late  in ('$islate')";
            } else {
                $sWhere .= " AND p.is_late  in ('$islate')";
            }
        }
        //print_r($data);exit;
        if (isset($data['date_of_birth_from']) && $data['date_of_birth_from'] != ""  && isset($data['date_of_birth_to']) && $data['date_of_birth_to'] != "" ) {
          
            
             $fromdate=  $data['date_of_birth_from'];
              $todate=  $data['date_of_birth_to'];
            if ($sWhere == "") {
                $sWhere = "WHERE (YEAR(NOW()) - YEAR(p.date_of_birth)) BETWEEN {$fromdate} AND {$todate}";
            } else { 
                $sWhere .= " AND  (YEAR(NOW()) - YEAR(p.date_of_birth)) BETWEEN {$fromdate} AND {$todate}";
            }
        }
        $sJoin = "";
        if( isset($data['homesuburb']) && is_array($data['homesuburb'])) {
            $homesuburb = implode("','", $data['homesuburb']);
            $sJoin = " INNER JOIN address as a ON a.id = p.address_id";
            if ($sWhere == "") {
                $sWhere = "WHERE a.suburb  in ('$homesuburb')";
                 
            } else {
                $sWhere .= " AND a.suburb in ('$homesuburb')";
            }
        }
        
        if( isset($data['homestate']) && is_array($data['homestate'])) {
            $homeState = implode("','", $data['homestate']);
            $sJoin = " INNER JOIN address as a ON a.id = p.address_id";
            if ($sWhere == "") {
                $sWhere = "WHERE a.state  in ('$homeState')";
                 
            } else {
                $sWhere .= " AND a.state in ('$homeState')";
            }
        }
        
        if( isset($data['homecity']) && is_array($data['homecity'])) {
            $homeCity = implode("','", $data['homecity']);
            $sJoin = " INNER JOIN address as a ON a.id = p.address_id";
            if ($sWhere == "") {
                $sWhere = "WHERE a.city  in ('$homeCity')";
                 
            } else {
                $sWhere .= " AND a.city in ('$homeCity')";
            }
        }
        
        if( isset($data['businesscity']) && is_array($data['businesscity'])) {
            $bCity = implode("','", $data['businesscity']);
            $sJoin = " INNER JOIN address as a2 ON a2.id = p.business_address_id";
            if ($sWhere == "") {
                $sWhere = "WHERE a2.city  in ('$bCity')";
                 
            } else {
                $sWhere .= " AND a2.city in ('$bCity')";
            }
        }
        if( isset($data['businessstate']) && is_array($data['businessstate'])) {
            $bState = implode("','", $data['businessstate']);
            $sJoin = " INNER JOIN address as a2 ON a2.id = p.business_address_id";
            if ($sWhere == "") {
                $sWhere = "WHERE a2.state  in ('$bState')";                 
            } else {
                $sWhere .= " AND a2.state in ('$bState')";
            }
        }
        
        if( isset($data['businesssuburb']) && is_array($data['businesssuburb'])) {
            $bSuburb = implode("','", $data['businesssuburb']);
            $sJoin = " INNER JOIN address as a2 ON a2.id = p.business_address_id";
            if ($sWhere == "") {
                $sWhere = "WHERE a2.city  in ('$bSuburb')";
                 
            } else {
                $sWhere .= " AND a2.city in ('$bSuburb')";
            }
        }
        //  echo $village;  
//      echo  $sWhere;
//
//exit;
        //$sGroup = " group by p.mobile_number";

       $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS p.id, p.first_name, p.last_name,p.village,p.mobile_number,p.date_of_birth,p.sect,p.martial_status
            FROM   $sTable  
                $sJoin    
            $sWhere               
            
            $sOrder
            $sLimit
            ";

        $rResult = $this->query($sQuery);

        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() as total";
        
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
            
            foreach ($value['p'] as $k => $v) {
                $row[] = $v;
            }
            $output['aaData'][] = $row;
        }

        return $output;
        
    }

    public function getChildren($fatherId, $gender = false, $groupId = false) {
        $this->recursive = -1;
        if ($gender == 'Male') {
            $options['conditions']['People.f_id'] = $fatherId;
        } else {
            $options['conditions']['People.m_id'] = $fatherId;
        }

        if ($groupId) {
            // $options['conditions']['People.group_id'] = $groupId;
        }
        $options['fields'] = array('concat(People.first_name,"  ",People.last_name) as childname', 'People.id', 'People.group_id');
        $options['order'] = array(
             'People.date_of_birth ASC'
             );
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

    public function getPeopleData($userId, $type = false, $groupId = false) {
        $this->recursive = -1;
        if ($type) {
            $options['conditions']['People.id'] = $userId;
        } else {
            $options['conditions']['People.user_id'] = $userId;
        }
        if ($groupId) {
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
        }
        if ($groupId) {
            $options['fields'] = array('People.*', 'Group.tree_level');
        } else {
            $options['fields'] = array('People.*');
        }
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
    public function getFamilyDetails($groupId, $pid = false, $getAllDetails = false, $flag = false) {

        $this->recursive = -1;
        $options['conditions']['Group.group_id'] = $groupId;

        if ($pid) {
            $options['conditions']['People.id'] = $pid;
        }
        if ($getAllDetails) {
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
                    'alias' => 'parent3',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'parent3.id = People.partner_id'
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
                array('table' => 'translations',
                    'alias' => 't',
                    'type' => 'left',
                    'conditions' => array(
                        't.name = People.last_name'
                    )
                ),
                array('table' => 'translations',
                    'alias' => 't1',
                    'type' => 'left',
                    'conditions' => array(
                        't1.name = People.first_name'
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
		            'People.id  = exspouse.people_id '
		        )
		    )
            );
        }
        if ($getAllDetails) {
            $options['fields'] = array('People.*', 'Group.tree_level', 'Group.people_id',
                'concat_ws(" ",grandfather.first_name,grandfather.last_name) as grandfather',
                'concat_ws(" ",grandfatherm.first_name,grandfatherm.last_name) as grandfather_mother',
                'Address.phone1', 't.gujurathi_text', 't.hindi_text', 't1.gujurathi_text', 't1.hindi_text',
                'parent3.first_name as partner_name', 'parent1.first_name as father', 'parent2.first_name as mother'
            );
        } else {
             $options['fields'] = array('People.*','Group.tree_level','Group.people_id','group_concat(exspouse.spouse_id) as exspouses');
            //$options['fields'] = array('People.*', 'Group.tree_level', 'Group.people_id');
            if ($flag) {
                //$options['fields'][] = array('secondary as secondary');
            }
        }

//        $options['order'] = array(
//                                'CASE WHEN (People.tree_level = "" AND People.group_id = "'.$groupId.'") THEN 0 ELSE 1 END',
//                                'CASE WHEN People.date_of_birth IS NULL OR People.date_of_birth = "0000-00-00" THEN 1 ELSE 0 END',
//                                'CASE WHEN People.is_late = 1 THEN 0 ELSE 1 END',
//                                );
        
          $options['order'] = array(
             'People.is_late ASC','People.id ASC'
             );
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
	
    public function getBrothers($peopleId) {
        
        $this->recursive = -1;
        $options['conditions'] = array('b.people_id' => $peopleId);
        $options['joins'] = array(
            array('table' => 'brothers',
                'alias' => 'b',
                'type' => 'INNER',
                'conditions' => array(
                    'b.brother_id = People.id'
                )
            ),);
        $options['fields'] = array('People.id', 'People.first_name','b.brother_id');
        try {
            $userData = $this->find('all', $options);
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

     public function getSisters($peopleId) {
        
        $this->recursive = -1;
        $options['conditions'] = array('b.people_id' => $peopleId);
        $options['joins'] = array(
            array('table' => 'sisters',
                'alias' => 'b',
                'type' => 'INNER',
                'conditions' => array(
                    'b.sister_id = People.id'
                )
            ),);
        $options['fields'] = array('People.id', 'People.first_name','b.sister_id');
        try {
            $userData = $this->find('all', $options);
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

    
    public function getAllSpouses($id) {
		$this->recursive = -1;
		$options['conditions'] = array('People.partner_id' => $id,'People.gender'=> 'Female' );
        $options['fields'] = array('People.id','People.first_name');
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

    public function updateAfterDeletion($id) {
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
    
    public function makeHof($id, $hofId, $groupId) 
    {
        $this->recursive = -1;
        

               
        $backUpdateAllTreeLevels = "UPDATE {$this->tablePrefix}people_groups
                  SET tree_level = $hofId           
                  WHERE people_id = {$hofId} and group_id = {$groupId}";          
                  
        
      $query = "UPDATE {$this->tablePrefix}people_groups
                  SET tree_level = ''            
                  WHERE people_id = {$id} and group_id = {$groupId}";
                  
                  $query1=  "UPDATE {$this->tablePrefix}people
                  SET tree_level = $hofId 
                  WHERE id = {$hofId} and group_id = {$groupId}";          
      $query2 = "UPDATE {$this->tablePrefix}people
                  SET tree_level = ''            
                  WHERE id = {$id} and group_id = {$groupId}";
                  
    $updateGroup = "UPDATE {$this->tablePrefix}groups
                  SET people_id = $id            
                  WHERE people_id = {$hofId}";              
                  
        try {
            
            $this->query($backUpdateAllTreeLevels);
            $this->query($query);
            $this->query($query1);
            $this->query($query2);
            $this->query($updateGroup);

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

    public function updateFatherDetails($data) {
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
    
    public function updateBrotherDetails($data) {
        $this->recursive = -1;

        $query = "UPDATE {$this->tablePrefix}people
                  SET b_id = '{$data['b_id']}' , brother = '{$data['brother']}'           
                  WHERE id = {$data['id']}";

        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
    
    public function updateSisterDetails($data) {
        $this->recursive = -1;

        $query = "UPDATE {$this->tablePrefix}people
                  SET s_id = '{$data['s_id']}' , sister = '{$data['sister']}'           
                  WHERE id = {$data['id']}";

        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }

    public function updateBusinessDetails($data) {
        $this->recursive = -1;

        $query = "UPDATE {$this->tablePrefix}people
                  SET occupation = '{$data['occupation']}' , business_name = '{$data['business_name']}'   
                      , nature_of_business = '{$data['nature_of_business']}', specialty_business_service = '{$data['specialty_business_service']}' ,
                          name_of_business = '{$data['name_of_business']}' ,
                          other_business_type = '{$data['other_business_type']}' 
                  WHERE id = {$data['id']}";

        try {
            $this->query($query);
            return true;
        } catch (ErrorException $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }

    public function updateMotherDetails($data) {
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
    public function getParentPeopleDetails($data = array(),$isHOF = true) {
        $this->recursive = -1;
        if (isset($data['gid'])) {
            $options['conditions'] = array('People.group_id' => $data['gid']);
        }
        
        if ($isHOF) {
            $options['conditions']['AND'] = array('People.tree_level' => '');
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


        $options['fields'] = array('People.id', 'People.first_name', 'People.business_address_id', 'People.address_id');
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

    public function checkExistingOwner($data) {

        $this->recursive = -1;
        $options['conditions']['AND'] = array('pgroup.tree_level' => '');
        if (!empty($data['first_name'])) {
            $options['conditions']['AND'][] = array('People.first_name' => $data['first_name']);
        }

        if (!empty($data['last_name'])) {
            $options['conditions']['AND'][] = array('People.last_name' => $data['last_name']);
        }
        if (!empty($data['village'])) {
            $options['conditions']['AND'][] = array('People.village' => $data['village']);
        }

        if (!empty($data['mobile_number'])) {
            $options['conditions']['AND'][] = array('People.mobile_number' => $data['mobile_number']);
        }

        if (!empty($data['email'])) {
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

    public function getAllRelationsIds($peopleId) {
        $this->recursive = -1;

        $options['conditions']['AND'] = array('People.id' => $peopleId);

        $options['fields'] = array('People.partner_id', 'People.f_id', 'People.m_id');
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

    public function getCallAgainMembers($userID) {

        $aColumns = array('id', 'first_name', 'last_name', 'mobile_number');

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
            $sWhere = "WHERE call_again = 1 and created_by = {$userID}";
        } else {
            $sWhere .= " AND call_again = 1 and created_by = {$userID}";
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

    public function getMissingData($userID, $roleID, $operatorid) {
        $aColumns = array('p.id', 'p.first_name', 'p.last_name', 'p.mobile_number');

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
		  $aSearchCollumns = array('p.id', 'p.first_name', 'p.last_name', 'p.mobile_number');
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
        if ($roleID == 1) {

            if ($operatorid) {
			 if ($sWhere == "") {
                $sWhere = "WHERE p.is_late = 0 and p.created_by = {$operatorid} ";
                
			} else {
				$sWhere .= "and p.is_late = 0 and p.created_by = {$operatorid} ";
			} 
			$sWhere .= "and  ((p.f_id IS  NULL) or 
			( p.m_id IS  NULL) or 
			( p.date_of_birth IS  NULL) or (  p.village IS  NULL or  p.village = '') or (  grandfather.first_name IS  NULL)
			or (  grandfatherm.first_name IS  NULL))";
            } else {
			if ($sWhere == "") {
                $sWhere = "WHERE p.is_late = 0";
				} else {
				$sWhere .= " and p.is_late = 0";
				}
            }
			//echo $sWhere;
        } else {
            if ($sWhere == "") {
                $sWhere = "WHERE p.is_late = 0 and p.created_by = {$userID} and p.created_by = {$userID} and  ((p.f_id IS  NULL) or 
			( p.m_id IS  NULL) 
			or( p.date_of_birth IS  NULL) or (  p.village IS  NULL or  p.village = '') or (  grandfather.first_name IS  NULL)
			or (  grandfatherm.first_name IS  NULL))";
            } else {
                $sWhere .= " AND p.is_late = 0 and p.created_by = {$userID} and  ((p.f_id IS  NULL) or 
			( p.m_id IS  NULL) or 
			( p.date_of_birth IS  NULL) or (  p.village IS  NULL or  p.village = '') or (  grandfather.first_name IS  NULL)
			or (  grandfatherm.first_name IS  NULL))";
            }
        }
//echo $sWhere;
        $sJoin = "  LEFT JOIN people as parent1 ON parent1.id = p.f_id
LEFT JOIN people as parent2 ON parent2.id = p.m_id
LEFT JOIN people as grandfather ON grandfather.id = parent1.f_id
LEFT JOIN people as grandfatherm ON grandfatherm.id = parent2.f_id
                    ";

        /*
         * SQL queries
         * Get data to display
         */

       $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS p.id,p.group_id,p.first_name,p.last_name,
REPLACE(CONCAT(if( p.non_kvo = 0 and (p.m_id = '' OR p.m_id IS NULL),'Mother','-'), ', ',
if( p.non_kvo = 0 and (p.f_id = '' OR p.f_id IS NULL),'Father','-'),', ',if(p.address_id = '' OR p.address_id IS NULL,'Home Address','-')
,', ',if(p.date_of_birth = '' OR p.date_of_birth IS NULL,'DOB','-')
,', ',if(p.village = '' OR p.village IS NULL,'Village','-')
,', ',if(p.non_kvo = 0 and (grandfather.first_name = '' OR grandfather.first_name IS NULL),'GrandFather' , '-')
,', ',if( p.non_kvo = 0 and (grandfatherm.first_name = '' OR grandfatherm.first_name IS NULL),'GrandFather-Mother' , '-')
),'-,','') as missingdata
            FROM   $sTable
$sJoin
            $sWhere
                having trim(missingdata) != '-'
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

            //if (trim($value[0]['missingdata']) != '-') {

                $row = array();
                foreach ($value['p'] as $k => $v) {
                    $row[] = $v;
                }
                $row[] = $value[0]['missingdata'];

                $row[] = '';
                $output['aaData'][] = $row;
           // }
        }

        return $output;
    }

    public function getCompletedRecords($userId, $roleId, $fromdate = false, $todate = false) {
        $aColumns = array('p.id', 'p.first_name', 'p.last_name', 'p.mobile_number', 'p.date_of_birth', 'grandfather.first_name');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

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
        if ($roleId == 1) {
            $sWhere = "  p.is_late = 0 ";
        } else {
            $sWhere = "  p.is_late = 0 and p.created_by = {$userId}";
        }
        if ($fromdate && $todate) {

            $fromDate = date_parse_from_format("d/m/Y", $fromdate);

            $fromdate = "$fromDate[year]-$fromDate[month]-$fromDate[day]";

            $toDate = date_parse_from_format("d/m/Y", $todate);
            $todate = "$toDate[year]-$toDate[month]-$toDate[day]";
             if (strtotime($fromdate) == strtotime($todate)) {
                 $sdate = " and p.modified =  '$fromdate'";
             } else  {
            $sdate = " and p.modified 
BETWEEN  '$fromdate'
AND  '$todate'";
           } 
        }


        /*
         * SQL queries
         * Get data to display
         */


       $sQuery = "
   SELECT SQL_CALC_FOUND_ROWS p.id,p.first_name,p.last_name,p.mother,p.father,grandfather.first_name,p.mobile_number,p.date_of_birth
            FROM   $sTable
  LEFT JOIN people as parent1 ON parent1.id = p.f_id
LEFT JOIN people as parent2 ON parent2.id = p.m_id
LEFT JOIN people as grandfather ON grandfather.id = parent1.f_id
LEFT JOIN people as grandfatherm ON grandfatherm.id = parent2.f_id
                    
            WHERE $sWhere and  (( p.non_kvo = 1 and (p.f_id IS NULL or p.f_id IS NOT NULL)) or( p.non_kvo = 0 and p.f_id IS not NULL)) and 
			(( p.non_kvo = 1 and (p.m_id IS NULL or p.m_id IS NOT NULL)) or ( p.non_kvo = 0 and p.m_id IS not NULL)) and 
			( p.date_of_birth IS NOT NULL) and (p.address_id IS NOT NULL and p.address_id != '' and p.address_id != '0') and (  p.village IS NOT NULL) and ( (p.non_kvo = 1 and (grandfather.first_name IS  NULL or grandfather.first_name IS NOT  NULL)) or  (p.non_kvo = 0 and grandfather.first_name IS NOT NULL))
			and ( ( p.non_kvo = 1 and (grandfatherm.first_name IS NULL or grandfatherm.first_name IS NOT NULL )) or ( p.non_kvo = 0 and grandfatherm.first_name IS NOT NULL) )  $sdate
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
            foreach ($value['p'] as $k => $v) {
                $row[] = $v;
            }
            $row[] = $value['grandfather']['first_name'];
            $output['aaData'][] = $row;
        }

        return $output;

//     $this->recursive = -1;
//        $dbh = $this->getDataSource();
//        
//		if ($fromdate &&  $todate) {
//
//$fromDate = date_parse_from_format("d/m/Y", $fromdate);
//
//$fromdate  = "$fromDate[year]-$fromDate[month]-$fromDate[day]";
//
//$toDate = date_parse_from_format("d/m/Y", $todate);
//$todate = "$toDate[year]-$toDate[month]-$toDate[day]";
//		$sdate = " and p.modified 
//BETWEEN  '$fromdate'
//AND  '$todate'";
//		 }
//        $result = $dbh->fetchAll("SELECT p.first_name,p.last_name,p.mother,p.father,grandfather.first_name,p.mobile_number,p.date_of_birth
//            FROM   people as p
//  LEFT JOIN people as parent1 ON parent1.id = p.f_id
//LEFT JOIN people as parent2 ON parent2.id = p.m_id
//LEFT JOIN people as grandfather ON grandfather.id = parent1.f_id
//LEFT JOIN people as grandfatherm ON grandfatherm.id = parent2.f_id
//                    
//            WHERE $sWhere and (p.f_id IS NOT NULL) and 
//			( p.m_id IS NOT NULL) and 
//			( p.date_of_birth IS NOT NULL) and (  p.village IS NOT NULL) and (  grandfather.first_name IS NOT NULL)
//			and (  grandfatherm.first_name IS NOT NULL)
//			$sdate
//			");
//        
//        return $result;
    }

    public function getCompletedCountLastWeek($userId) {
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

    public function getCompletedCountThisWeek($userId) {
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

    public function getInCompleteRecords() {
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

        $options['conditions'] = array('People.first_name like' => '%' . $term . '%');

        $options['fields'] = array('People.first_name', 'People.id');
        $options['group'] = array('People.first_name');
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

        $options['conditions'] = array('People.last_name like' => '%' . $term . '%');

        $options['fields'] = array('People.last_name', 'People.id');
        $options['group'] = array('People.last_name');
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

    public function fetchBusniessTypeName() {
        $this->recursive = -1;
        $options['conditions'] = array('People.business_name !=' => '');
       //  $options['conditions'] = array('People.nature_of_business like' => '%' . $term . '%');
        $options['fields'] = array('People.business_name', 'People.business_name');
         $options['group'] = array('People.business_name');
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
    
    public function fetchBusniessName() {
        $this->recursive = -1;
         $options['conditions'] = array('People.name_of_business !=' => '');
       //  $options['conditions'] = array('People.nature_of_business like' => '%' . $term . '%');
        $options['fields'] = array('People.name_of_business', 'People.name_of_business');
         $options['group'] = array('People.name_of_business');
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
    
    public function fetchSpecialityBusniessName() {
         $this->recursive = -1;
          $options['conditions'] = array('People.specialty_business_service !=' => '');
       //  $options['conditions'] = array('People.nature_of_business like' => '%' . $term . '%');
        $options['fields'] = array('People.specialty_business_service','People.specialty_business_service');
         $options['group'] = array('People.specialty_business_service');
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
    public function fetchNatureBusniessName() {
          $this->recursive = -1;
          $options['conditions'] = array('People.nature_of_business !=' => '');
       //  $options['conditions'] = array('People.nature_of_business like' => '%' . $term . '%');
        $options['fields'] = array('People.nature_of_business','People.nature_of_business');
         $options['group'] = array('People.nature_of_business');
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
    
    public function fetchOccupation()  {
          $this->recursive = -1;
         $options['conditions'] = array('People.occupation !=' => '');
        $options['fields'] = array('People.occupation','People.occupation');
         $options['group'] = array('People.occupation');
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
     public function fetchDateofBirth()  {
          $this->recursive = -1;
         $options['conditions'] = array('People.date_of_birth is not null');
        $options['fields'] = array('distinct(DATE_FORMAT(People.date_of_birth,"%Y")) as date_of_birth');
        $options['order'] = array('People.date_of_birth desc');
        try {
            $userData = $this->find('all', $options);
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
     
     public function getBusniessIds($group_id, $peopleId)  {
        $this->recursive = -1;
        $options['conditions'] = array(
                            'People.business_address_id is not null',
                            'People.group_id' => $group_id,
                            'People.id != ' => $peopleId
                            );
        $options['fields'] = array('People.business_address_id,People.first_name,People.last_name', 'address.*');
        $options['joins'] = array(
            array('table' => 'address',
                'alias' => 'address',
                'type' => 'left',
                'conditions' => array(
                    'address.id = People.business_address_id'
                )
            ),
        );
        try {
            $userData = $this->find('all', $options);
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
     
     public function getMissingFathers() {
        $length = $_GET['iDisplayLength'];
        $start = (isset($_GET['iDisplayStart']) && $_GET['iDisplayStart']) ? $_GET['iDisplayStart'] : 0;
        
        $sSql = "SELECT a.f_id FROM `people` a INNER JOIN `people` b ON a.f_id = b.id";
        $rResultId = $this->query($sSql);
        
        $ids = array();
        foreach ($rResultId as $key => $value) {
            foreach ($value as $k => $v) {
                foreach ($v as $fld => $fldval) {
                    $ids[] = $fldval;
                }
            }
        }
        
        $sQuery = "SELECT id, group_id, first_name, last_name, f_id FROM `people`
                    WHERE f_id NOT
                    IN ( ".implode(',',$ids)."
                    ) LIMIT " . $start . ", " . $length;
        $rResult = $this->query($sQuery);
        
        $sQry = "SELECT id FROM `people`
                    WHERE f_id NOT
                    IN ( ".implode(',',$ids)."
                    ) ";
        $rResultTot = $this->query($sQry);
        
        $iTotal = count($rResultTot);

        /*
         * Output
        */ 
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );

        foreach ($rResult as $key => $value) {
            $row = array();
            foreach ($value as $k => $v) {
                foreach ($v as $fld => $fldval) {
                    $row[] = $fldval;
                }
            }
            $row[] = '';
            $output['aaData'][] = $row;
        }
        return $output;
    }
    
    public function getMissingMothers() {
        $length = $_GET['iDisplayLength'];
        $start = (isset($_GET['iDisplayStart']) && $_GET['iDisplayStart']) ? $_GET['iDisplayStart'] : 0;
        
        $sSql = "SELECT a.m_id FROM `people` a INNER JOIN `people` b ON a.m_id = b.id";
        $rResultId = $this->query($sSql);
        
        $ids = array();
        foreach ($rResultId as $key => $value) {
            foreach ($value as $k => $v) {
                foreach ($v as $fld => $fldval) {
                    $ids[] = $fldval;
                }
            }
        }
        
        $sQuery = "SELECT id, group_id, first_name, last_name, m_id FROM `people`
                    WHERE m_id NOT
                    IN ( ".implode(',',$ids)."
                    ) LIMIT " . $start . ", " . $length;
        $rResult = $this->query($sQuery);
        
        $sQry = "SELECT id FROM `people`
                    WHERE m_id NOT
                    IN ( ".implode(',',$ids)."
                    ) ";
        $rResultTot = $this->query($sQry);
        
        $iTotal = count($rResultTot);


        /*
         * Output
        */ 
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );

        foreach ($rResult as $key => $value) {
            $row = array();
            foreach ($value as $k => $v) {
                foreach ($v as $fld => $fldval) {
                    $row[] = $fldval;
                }
            }
            $row[] = '';
            $output['aaData'][] = $row;
        }
        return $output;
    }
             
    public function getMatchingAddress() {
        $length = $_GET['iDisplayLength'];
        $start = (isset($_GET['iDisplayStart']) && $_GET['iDisplayStart']) ? $_GET['iDisplayStart'] : 0;
        $sQuery = "SELECT group_concat(people.id) matching_ids, people.group_id, address.wing, address.room_number, address.building_name, address.complex_name, address.plot_number, address.road, address.suburb, address.suburb_zone, address.city, address.state, address.zip_code
FROM people RIGHT JOIN address ON address.people_id = people.id WHERE people.id != ''
GROUP BY people.group_id, address.wing, address.room_number, address.building_name, address.complex_name, address.plot_number, address.road, address.suburb, address.suburb_zone, address.city, address.state, address.zip_code 
HAVING count(*) > 1 LIMIT ".$start.", ".$length;
        $rResult = $this->query($sQuery);
        
        $sQry = "SELECT people.group_id
FROM people RIGHT JOIN address ON address.people_id = people.id WHERE people.id != ''
GROUP BY people.group_id, address.wing, address.room_number, address.building_name, address.complex_name, address.plot_number, address.road, address.suburb, address.suburb_zone, address.city, address.state, address.zip_code 
HAVING count(*) > 1";
        $rResultTot = $this->query($sQry);
        
        $iTotal = count($rResultTot);


        /*
         * Output
        */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iTotal,
            "aaData" => array()
        );

        foreach ($rResult as $key => $value) {
            $data = array();
            foreach ($value as $k => $v) {
                foreach ($v as $fld => $fldval) {
                    if (in_array($fld, array(wing, room_number, building_name, complex_name, plot_number, road, suburb, suburb_zone))) {
                        if ($fldval != '') {                            
                            $data['address'][] = $fldval;
                        }
                    } elseif ($fld == 'matching_ids') {
                        $ids = explode(',', $fldval);
                        $data[$fld] = implode(', ',array_unique($ids));
                    } else {
                        $data[$fld] = $fldval;
                    }
                }
            }

            $output['aaData'][] = array($data['group_id'], implode (',', $data['address']), $data['city'], $data['state'], $data['zip_code'], $data['matching_ids'], '');
        }
        return $output; 

    }      
    
    public function removeRelation($id, $assocationId, $gid, $type)
    {
        $this->recursive = -1;
        if( $type == 'father') {
            $query = "UPDATE {$this->tablePrefix}people
                  SET f_id = '', father = ''            
                  WHERE id = {$id}";
        } else {
            $query = "UPDATE {$this->tablePrefix}people
                  SET m_id = '', mother = ''            
                  WHERE id = {$id}";
        }
                  
        try {
            $this->query($query);
            return true;
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }

    } 
    
    public function getParentHierarchy ($ids, $hierarchy = true) {
        //fetch parents and siblings
        $select = "SELECT a.f_id, a.m_id, GROUP_CONCAT(b.id) as siblings, GROUP_CONCAT(b.partner_id) as sibling_partners, GROUP_CONCAT(s.spouse_id) as exspouses  "
                . "FROM `people` a "
                . "LEFT JOIN `people` b ON (a.f_id = b.f_id || a.m_id = b.m_id) "
                . "LEFT JOIN `spouses` s ON (a.id = s.people_id || a.id = s.people_id) "
                . "WHERE a.id IN (".implode(',', $ids).") GROUP BY a.f_id, a.m_id";
        $rResult = $this->query($select);
  
        $parents = array();
        
        foreach ($rResult as $k => $v) {
            if ($v['a']['f_id']) {
                $this->arrIds[] = $parents[] = $v['a']['f_id'];
            }
            if ($v['a']['m_id']) {
                $this->arrIds[] = $parents[] = $v['a']['m_id'];
            }            
            
            if (count($v[0]['siblings'])) {
                $siblings = explode(',', $v[0]['siblings']);
                foreach ($siblings as $sid) {
                    if ($sid) {
                        $this->arrIds[] = $sid;
                    }
                }
            }
            if (count($v[0]['sibling_partners'])) {
                $sibling_partners = explode(',', $v[0]['sibling_partners']);
                foreach ($sibling_partners as $spid) {
                    if ($spid) {
                        $this->arrIds[] = $spid;
                    }
                }
            }
            if (count($v[0]['exspouses'])) {
                $exspouses = explode(',', $v[0]['exspouses']);
                foreach ($exspouses as $exspid) {
                    if ($exspid) {
                        $this->arrIds[] = $exspid;
                    }
                }
            }
        }
        
        if ($hierarchy && count($parents)) {
            $this->getParentHierarchy ($parents, true);
        }
    }
    
    public function getChildHierarchy($id, $hierarchy = true) {
        //fetch child and child partner
        $select = "SELECT b.id, b.partner_id, s.spouse_id "
                . "FROM `people` a "
                . "LEFT JOIN `people` b ON (a.id = b.f_id || a.id = b.m_id) "
                . "LEFT JOIN `spouses` s ON (a.id = s.people_id) "
                . "WHERE a.id='" . $id . "'";
        $rResult = $this->query($select);    
        
        foreach ($rResult as $k => $v) {
            if ($v['b']['id']) {
                $this->arrIds[] = $v['b']['id'];

                if ($hierarchy) {
                    $this->getChildHierarchy($v['b']['id'], true);
                }
            }
            if ($v['b']['partner_id']) {
                $this->arrIds[] = $v['b']['partner_id'];
            }
            if ($v['s']['spouse_id']) {
                $this->arrIds[] = $v['s']['spouse_id'];
            }
        }
    }

    public function getPeopleDetail ($id) {
        //fetch parents, siblings, partner
        $select = "SELECT a.f_id, a.m_id, a.partner_id, b.id, b.partner_id, c.f_id, c.m_id, s.spouse_id "
                . "FROM `people` a "
                . "LEFT JOIN `people` b ON (a.f_id = b.f_id || a.m_id = b.m_id) "
                . "LEFT JOIN `people` c ON (a.partner_id = c.id) "
                . "LEFT JOIN `spouses` s ON (a.id = s.spouse_id) "
                . "WHERE a.id='".$id."'";
        $rResult = $this->query($select);
        
        $sibling =  $siblingPartner = array();  
        
        $this->arrIds[] = $id;
        
        $father = $rResult[0]['a']['f_id'];
        $mother = $rResult[0]['a']['m_id'];
        
        if ($rResult[0]['a']['partner_id']) {
            $this->arrIds[] = $partner = $rResult[0]['a']['partner_id'];
        }
        if ($rResult[0]['c']['m_id']) {
            $this->arrIds[] = $partner_mother = $rResult[0]['c']['m_id'];
        }
        if ($rResult[0]['c']['f_id']) {
            $this->arrIds[] = $partner_father = $rResult[0]['c']['f_id'];
        }
        if ($rResult[0]['s']['spouse_id']) {
            $this->arrIds[] = $exspouse = $rResult[0]['s']['spouse_id'];
        }

        foreach ($rResult as $k => $v) {
            $this->arrIds[] = $sibling[] = $v['b']['id'];
            $this->arrIds[] = $siblingPartner[] = $v['b']['partner_id'];
        }
        
        //get siblings children
        foreach ($sibling as $sid) {
            if ($sid) {
                $this->getChildHierarchy($sid, false);
            }
        }
        
        //get self children hierarchy
        $this->getChildHierarchy($id, true);
        
        //get father's, mother's ancestors and siblings
        if ($father || $mother) {
            $arrParent = array();
            
            if ($father) {
                $this->arrIds[] = $arrParent[] = $father;
            }
            if ($mother) {
                $this->arrIds[] = $arrParent[] = $mother;
            }
            $this->getParentHierarchy ($arrParent, true);
        }
    

        //fetch detail of all ids
        $family = $this->getIdsDetail();
        
        return $family;
    }
    
    public function getIdsDetail () {
        $fData = array_unique(array_filter($this->arrIds));
      
        $sQry = "SELECT people.*, people_groups.tree_level, people_groups.people_id, group_concat(spouses.spouse_id) as exspouses FROM"
                . " people LEFT JOIN people_groups ON people.id=people_groups.people_id "
                . " LEFT JOIN spouses ON people.id  = spouses.people_id "
                . " WHERE people.id IN (".implode(',', $fData).") "
                . " GROUP BY people.id ORDER BY people_groups.tree_level ASC";
        $aResult = $this->query($sQry);
        
        return $aResult;

    }
    
    public function getPeopleName($userId, $encode = false) {
        $cond =  "people.id = '{$userId}'";
        if ($encode) {
            $cond = "md5(people.id) = '{$userId}'";
        }
        
        $sQry = "SELECT first_name, last_name FROM"
                . " people  WHERE {$cond}";
        $aResult = $this->query($sQry);

        return $aResult[0];
    }
}

