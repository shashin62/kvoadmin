<?php

App::uses('AppModel', 'Model');

class Group extends AppModel {
    
     var $name = 'Group';
     
     public function getAllFamilyGroups($userId) {
         
       $aColumns = array('grp.id', 'grp.name','parent.first_name',
           'parent.last_name','parent.phone_number','parent.date_of_birth','grp.created');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "grp.id";

        /* DB table to use */
        $sTable = "groups as grp";

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
        
        $aSearchCollumns = array('parent.id','parent.first_name','parent.last_name','parent.date_of_birth','parent.phone_number',);
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
//        if( $roleId  == 1){
//            if ($sWhere == "") {
//                    $sWhere = " WHERE user_id =  {$userId}";
//                } else {
//                    $sWhere .= " AND ";
//                }
//        }
        
         $sJoin = "  INNER JOIN people as parent ON (parent.id = grp.people_id)";
         
        /*
         * SQL queries
         * Get data to display
         */
    $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS grp.id,parent.first_name,
    parent.last_name,parent.date_of_birth,parent.phone_number,grp.created
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
            $row[] = $value['grp']['id'];
            foreach ($value['parent'] as $k => $v) {
                $row[] = ucfirst(strtolower($v));
            }
            $row[] = $value['grp']['created'];

            $row[] = '';
            $output['aaData'][] = $row;
        }

//        echo '<pre>';
//        print_r($output);
//        echo '</pre>';
        return $output;
    }
    
}

