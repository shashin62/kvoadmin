<?php

App::uses('AppModel', 'Model');

class BusinessType extends AppModel {
    
     var $name = 'BusinessType';
     var $table = 'business_types';
     
     
      /**
     * Function to check if name exists in table
     * 
     * @param type $name
     * 
     * @return boolean 
     */
    public function checkBusinessTypeExists($name) {
        $this->recursive = -1;
        $options['conditions'] = array('BusinessType.name' => $name);
        $options['fields'] = array('BusinessType.id');
        try {
            $data = $this->find('all', $options);
            if ($data && isset($data[0]['BusinessType']) && $data[0]['BusinessType'] != "") {
                return $data[0]['BusinessType'];
            } else {
                return array();
            }
        } catch (Exception $e) {
            CakeLog::write('db', __FUNCTION__ . " in " . __CLASS__ . " at " . __LINE__ . $e->getMessage());
            return false;
        }
    }
     
     
     public function getAllBusinessTypes() {
         
        /* DB table to use */
        $sTable = $this->table;
        
        $aColumns = array('business_types.id', 'business_types.name', 'business_natures.name AS business_nature','business_types.status', 'business_types.created', 'business_types.business_nature_id');
        $selColumns = array('id', 'name', 'business_nature','status', 'created', 'business_nature_id');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";


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
                    $sOrder .=  $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
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
                $sWhere .=  $aColumns[$i] . " LIKE '%" . ($_GET['sSearch']) . "%' OR ";
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
                $sWhere .=  $aColumns[$i] . " LIKE '%" . ($_GET['sSearch_' . $i]) . "%' ";
            }
        }
        
        /*join with business nature*/
        $sJoin = " LEFT JOIN `business_natures` ON (".$sTable.".business_nature_id = business_natures.id) ";

        /*
         * SQL queries
         * Get data to display
         */


        $sQuery = "
    SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . "
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
            for ($i = 0; $i < count($selColumns); $i++) {
               if ($selColumns[$i] == 'status') {
                    switch ($value[$this->table][$selColumns[$i]]) {
                        case 1:
                            $status = 'Active';

                            break;

                        default:
                            break;
                    }
                     $row[] = $status;
               } elseif ($selColumns[$i] == 'business_nature') {
                   $row[] = $value['business_natures']['business_nature'];
               } else {
                   $row[] = $value[$this->table][$selColumns[$i]];
               }                
            }
            $row[] = '';
            $output['aaData'][] = $row;
        }
        return $output;
    }
    
}

