<?php

/**
 * Controller file
 *
 * PHP version 5.5
 *
 * @category  Controller
 * @package   Kvo Admin
 * @author    S
 * @copyright 2014 Kvo Admin
 * @version   GIT:$
 * @since     1.0
 */
App::uses('AppController', 'Controller');

/**
 * Controller class for Family Controller
 * 
 * @category  Controiller
 * @package   Kvo Admin
 * @author    S
 * @copyright 2014 Kvo Admin
 * @since     1.0
 */
Class FamilyController extends AppController {

    /**
     *
     * @var type 
     */
    public $name = 'Family';

    /**
     *
     * @var array 
     */
    public $uses = array('User', 'Aro', 'Role',
        'People', 'Village', 'Education', 'State', 'BloodGroup', 'Group','Address');

    /**
     *
     * @var type 
     */
    public $helpers = array('Session');
    /**
     *
     * @var type 
     */
    public $components = array('Session');
    /**
     * index function - page landing
     */
    public function index() 
    {
        $requestData = $this->request->data;
        
        if ($requestData['type'] == 'self') {
           $userId = $requestData['fid'];//$this->Session->read('User.user_id');
            $toFetchData = true;
            $peopleId = $requestData['fid'];
        } else {
            $userId = '';
            $toFetchData = false;
            $peopleId = $requestData['fid'];
        }
        
        switch ($requestData['type']) 
        {
            case 'addspouse':
                $pageTitle = 'Add Spouse';
                break;
            case 'addfather':
                $pageTitle = 'Add Father';
                break;
            case 'addmother':
                $pageTitle = 'Add Mother';
                break;
            case 'addchilld':
                $pageTitle = 'Add Child';
                break;
            case 'addnew':
                $pageTitle = 'Add New Family';
                
                break;
            default:
                $requestData['type'] = 'self';
                $pageTitle = 'Create your family - edit your Details';
                break;
        }
        
        $this->set('gid', $requestData['group_id']);
        $this->set('pid', $peopleId);
        $this->set('pageTitle', $pageTitle);
        $this->set('userType', $requestData['type']);
        
        $villages = $this->Village->find('list', array('fields' => array('Village.name', 'Village.name')));
        $this->set(compact('villages'));

        $educations = $this->Education->find('list', array('fields' => array('Education.name', 'Education.name')));
        $this->set(compact('educations'));

        $states = $this->State->find('list', array('fields' => array('State.name', 'State.name')));
        $this->set(compact('states'));

        $bloodgroups = $this->BloodGroup->find('list', array('fields' => array('BloodGroup.name', 'BloodGroup.name')));
        $this->set(compact('bloodgroups'));

        $sessionData = $this->Session->read('User');

        if ($requestData['type'] == 'self') {
           
            $getPeopleData = $this->People->getPeopleData($userId, $toFetchData);
            
            $this->set('first_name', $getPeopleData['People']['first_name']);
             $this->set('date_of_birth', $getPeopleData['People']['date_of_birth']);
              $this->set('date_of_marriage', $getPeopleData['People']['date_of_marriage']);
            $this->set('address_id', $getPeopleData['People']['address_id']);
            $this->set('last_name', $getPeopleData['People']['last_name']);
            $this->set('phone_number', $getPeopleData['People']['phone_number'] ? $getPeopleData['People']['phone_number'] : $sessionData['phone_number'] );
            $this->set('email', $getPeopleData['People']['email']);
            $this->set('gender', $getPeopleData['People']['gender']);
            $this->set('martial_status', $getPeopleData['People']['martial_status']);
            $this->set('surname_now', $getPeopleData['People']['surname_now']);
            $this->set('surname_dob', $getPeopleData['People']['surname_dob']);
             $this->set('title', $getPeopleData['People']['title']);
            $this->set('state', $getPeopleData['People']['state']);
            $this->set('education', $getPeopleData['People']['education']);
            $this->set('village', $getPeopleData['People']['village']);
            $this->set('blood_group', $getPeopleData['People']['blood_group']);
        }
    }
    
    public function insertUser()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        
        $type = $_REQUEST['type'];
        $idToBeUpdated = $_REQUEST['id'];
        $gid = $_REQUEST['gid'];
        
        $getPeopleDetail = $this->People->find('all', array(
            'conditions' => array('People.id' => $_REQUEST['peopleid']))
            );
        $this->request->data = $getPeopleDetail[0];
        $updatePeople = array();
        switch ($type) {
            case 'addfather':
                unset($this->request->data['People']['id']);
                unset($this->request->data['People']['tree_level']);
                unset($this->request->data['People']['group_id']);
                $this->request->data['People']['tree_level'] = $idToBeUpdated;
                $this->request->data['People']['group_id'] = $gid;
                
                $this->People->create();
                if ( $this->People->save($this->request->data) ) {
                    $fatherId = $this->People->id;
                
                $updatePeople['People']['f_id'] = $fatherId;
                $updatePeople['People']['father'] = $getPeopleDetail[0]['People']['first_name'];
                $updatePeople['People']['id'] = $idToBeUpdated;
                $message  = 'Father has been added';
                }
                
                break;
            case 'addmother':
                unset($this->request->data['People']['id']);
                unset($this->request->data['People']['tree_level']);
                unset($this->request->data['People']['group_id']);
                $this->request->data['People']['tree_level'] = $idToBeUpdated;
                $this->request->data['People']['group_id'] = $gid;
                $this->People->create();
                if ( $this->People->save($this->request->data) ) {
                    $motherId = $this->People->id;
                    $updatePeople['People']['m_id'] = $motherId;
                    $updatePeople['People']['mother'] = $getPeopleDetail[0]['People']['first_name'];
                    $updatePeople['People']['id'] = $idToBeUpdated;
                    $message  = 'Mother has been added';
                }
                
                break;
            default:
                break;
        }
        
        if ( $this->People->save($updatePeople) ) {
            $msg['status'] = 1;
            
        } else {
            $msg['status'] = 0;
            $message = 'System Error';
        }
        
        if ($msg['status'] == 1) {
            $msg['success'] = 1;
            $msg['message'] = $message;
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }
        
        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }

    /**
     *  AJAX Callback - function to edit own details for creating tree
     */
    public function editOwnDetails() 
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $userID = $this->Session->read('User.user_id');
        
        $data = $this->request->data['People'];
        if ($_REQUEST['peopleid'] != '') {
            $getPeopleDetail = $this->People->find('all', array('fields' => array('People.first_name',
                    'People.last_name', 'People.surname_now', 'People.group_id',
                'People.f_id','People.partner_id','People.m_id','People.partner_name'),
                'conditions' => array('People.id' => $_REQUEST['peopleid']))
            );
        }
        
         $this->request->data['People']['title'] = $this->request->data['title'];
         $this->request->data['People']['gender'] = $this->request->data['gender'];
        $this->request->data['People']['martial_status'] = $this->request->data['martial_status'];
        switch ($_REQUEST['type']) {
            
            case 'addnew':
                
               
                
                $msg['status'] = 1;
                $result = $this->People->checkEmailExists($this->request->data['People']['email']);

                if (!empty($result) && $this->request->data['People']['id'] == '') {
                    $msg['status'] = 0;
                    $msg['error']['name'][] = "email";
                    $msg['error']['errormsg'][] = __('This Email already exists.');
                }

                if (isset($this->request->data['People']['phone_number'])) {
                    $phoneData = $this->People->checkPhoneExists($this->request->data['People']['phone_number']);

                    if (!empty($phoneData) && $this->request->data['People']['id'] == '') {
                        $msg['status'] = 0;
                        $msg['error']['name'][] = "phone_number";
                        $msg['error']['errormsg'][] = __('This Phone already exists.');
                    }
                }
                if ($msg['status'] == 1) {
                     $groupData = array();
                $groupData['Group']['name'] = 'Family of ' . $this->request->data['People']['first_name'];
                $groupData['Group']['created'] = date('Y-m-d H:i:s');
                $this->Group->save($groupData);
                    $this->request->data['People']['group_id'] = $this->Group->id;
                    if ($this->People->save($this->request->data)) {

                        $msg['status'] = 1;
                        $message = 'Family has been created';
                    } else {
                    $msg['success'] = 0;
                    $msg['message'] = 'System Error, Please trye again';
                }
                }
                
                break;
            case 'addspouse':
                $this->request->data['People']['partner_id'] = $_REQUEST['peopleid'];
                $this->request->data['People']['tree_level'] = $userID == $_REQUEST['peopleid'] ? 'START' : $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                
                $msg['status'] = 1;
                $result = $this->People->checkEmailExists($this->request->data['People']['email']);

                if (!empty($result) && $this->request->data['People']['id'] == '') {
                    $msg['status'] = 0;
                    $msg['error']['name'][] = "email";
                    $msg['error']['errormsg'][] = __('This Email already exists.');
                }

                if (isset($this->request->data['People']['phone_number'])) {
                    $phoneData = $this->People->checkPhoneExists($this->request->data['People']['phone_number']);

                    if (!empty($phoneData) && $this->request->data['People']['id'] == '') {
                        $msg['status'] = 0;
                        $msg['error']['name'][] = "phone_number";
                        $msg['error']['errormsg'][] = __('This Phone already exists.');
                    }
                }

                $name = $getPeopleDetail[0]['People']['first_name'] . '' . $getPeopleDetail[0]['People']['lastname'];
                $this->request->data['People']['partner_name'] = $name;
                if ($msg['status'] == 1) {
                    if ($this->People->save($this->request->data)) {
                        $msg['status'] = 1;
                        $partnerId = $this->People->id;
                        $updateParentUser = array();
                        $updateParentUser['partner_id'] = $partnerId;
                        $updateParentUser['partner_name'] = $this->request->data['People']['first_name'];
                        $updateParentUser['id'] = $_REQUEST['peopleid'];
                        $this->People->updateSpouseDetails($updateParentUser);
                        $message = 'Spouse has been added';
                    }
                } else {
                    $msg['success'] = 0;
                    $msg['message'] = 'System Error, Please trye again';
                }

                break;
            case 'addfather':

                $this->request->data['People']['tree_level'] = $userID == $_REQUEST['peopleid'] ? 'START' : $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                
                $msg['status'] = 1;
                $result = $this->People->checkEmailExists($this->request->data['People']['email']);

                if (!empty($result) && $this->request->data['People']['id'] == '') {
                    $msg['status'] = 0;
                    $msg['error']['name'][] = "email";
                    $msg['error']['errormsg'][] = __('This Email already exists.');
                }

                if (isset($this->request->data['People']['phone_number'])) {
                    $phoneData = $this->People->checkPhoneExists($this->request->data['People']['phone_number']);

                    if (!empty($phoneData) && $this->request->data['People']['id'] == '') {
                        $msg['status'] = 0;
                        $msg['error']['name'][] = "phone_number";
                        $msg['error']['errormsg'][] = __('This Phone already exists.');
                    }
                }
                if ($msg['status'] == 1) {


                    if ($this->People->save($this->request->data)) {
                        $msg['status'] = 1;
                        $fatherId = $this->People->id;
                        $updateParentUser = array();
                        $updateParentUser['f_id'] = $fatherId;
                        $updateParentUser['father'] = $this->request->data['People']['first_name'];
                        $updateParentUser['id'] = $_REQUEST['peopleid'];
                        $this->People->updateFatherDetails($updateParentUser);
                        //check if mother exists in table for child
                        $getMotherDetails = $this->People->find('all', array('fields' => array('People.m_id', 'People.mother'),
                            'conditions' => array('People.id' => $_REQUEST['peopleid']))
                        );

                        if (!empty($getMotherDetails[0]['People']['m_id'])) {
                            $data = array();
                            $data['partner_id'] = $getMotherDetails[0]['People']['m_id'];
                            $data['partner_name'] = $getMotherDetails[0]['People']['mother'];
                            $data['id'] = $fatherId;
                            $this->People->updateSpouseDetails($data);

                            //back update father row for parter details
                            $data = array();
                            $data['partner_id'] = $fatherId;
                            $data['partner_name'] = $this->request->data['People']['first_name'];
                            $data['id'] = $getMotherDetails[0]['People']['m_id'];
                            $this->People->updateSpouseDetails($data);
                        }

                        $message = 'Father has been added';
                    }
                } else {
                     $msg['success'] = 0;
                    $msg['message'] = 'System Error, Please trye again';
                }

                break;
                case 'addchilld':

                $this->request->data['People']['tree_level'] = $userID == $_REQUEST['peopleid'] ? 'START' : $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                $this->request->data['People']['f_id'] = $_REQUEST['peopleid'];
                $this->request->data['People']['m_id'] = $getPeopleDetail[0]['People']['partner_id'];
                $this->request->data['People']['father']  = $getPeopleDetail[0]['People']['first_name'];
                $this->request->data['People']['mother']  = $getPeopleDetail[0]['People']['partner_name'];
                 $msg['status'] = 1;
                $result = $this->People->checkEmailExists($this->request->data['People']['email']);

                if (!empty($result) && $this->request->data['People']['id'] == '') {
                    $msg['status'] = 0;
                    $msg['error']['name'][] = "email";
                    $msg['error']['errormsg'][] = __('This Email already exists.');
                }

                if (isset($this->request->data['People']['phone_number'])) {
                    $phoneData = $this->People->checkPhoneExists($this->request->data['People']['phone_number']);

                    if (!empty($phoneData) && $this->request->data['People']['id'] == '') {
                        $msg['status'] = 0;
                        $msg['error']['name'][] = "phone_number";
                        $msg['error']['errormsg'][] = __('This Phone already exists.');
                    }
                }
                if ($msg['status'] == 1) {
                    if ($this->People->save($this->request->data)) {
                        $msg['status'] = 1;
                        $message = 'Child has been added';
                    }
                } else {
                    $msg['success'] = 0;
                    $msg['message'] = 'System Error, Please trye again';
                }

                break;
            case 'addmother':

                $this->request->data['People']['tree_level'] = $userID == $_REQUEST['peopleid'] ? 'START' : $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                
                $msg['status'] = 1;
                $result = $this->People->checkEmailExists($this->request->data['People']['email']);

                if (!empty($result) && $this->request->data['People']['id'] == '') {
                    $msg['status'] = 0;
                    $msg['error']['name'][] = "email";
                    $msg['error']['errormsg'][] = __('This Email already exists.');
                }

                if (isset($this->request->data['People']['phone_number'])) {
                    $phoneData = $this->People->checkPhoneExists($this->request->data['People']['phone_number']);

                    if (!empty($phoneData) && $this->request->data['People']['id'] == '') {
                        $msg['status'] = 0;
                        $msg['error']['name'][] = "phone_number";
                        $msg['error']['errormsg'][] = __('This Phone already exists.');
                    }
                }
                 if ($msg['status'] == 1) {
                if ($this->People->save($this->request->data)) {
                    $msg['status'] = 1;
                    $motherId = $this->People->id;
                    $updateParentUser = array();
                    $updateParentUser['m_id'] = $motherId;
                    $updateParentUser['mother'] = $this->request->data['People']['first_name'];
                    $updateParentUser['id'] = $_REQUEST['peopleid'];
                    $this->People->updateMotherDetails($updateParentUser);
                    //check if father exists in table for child
                    $getFatherDetails = $this->People->find('all', array('fields' => array('People.f_id', 'People.father'),
                        'conditions' => array('People.id' => $_REQUEST['peopleid']))
                    );
                    if (!empty($getFatherDetails[0]['People']['f_id'])) {
                        $data = array();
                        $data['partner_id'] = $getFatherDetails[0]['People']['f_id'];
                        $data['partner_name'] = $getFatherDetails[0]['People']['father'];
                        $data['id'] = $motherId;
                        $this->People->updateSpouseDetails($data);

                        //back update father row for parter details
                        $data = array();
                        $data['partner_id'] = $motherId;
                        $data['partner_name'] = $this->request->data['People']['first_name'];
                        $data['id'] = $getFatherDetails[0]['People']['f_id'];
                        $this->People->updateSpouseDetails($data);
                    }

                    $message = 'Mother has been added';
                }
                 }else {
                    $msg['success'] = 0;
                    $msg['message'] = 'System Error, Please trye again';
                }

                break;
            default:
                $checkExistingUser = $this->People->find('all', array('fields' => array('People.id'),
                    'conditions' => array('People.id' => $_REQUEST['peopleid']))
                );

                if (count($checkExistingUser)) {
                    $this->request->data['People']['id'] = $_REQUEST['peopleid'];
                    if ($this->People->save($this->request->data)) {
                        $msg['status'] = 1;
                    } else {
                        $msg['status'] = 0;
                    }
                }
                $message = 'Information updated';
                break;
        }



        if ($msg['status'] == 1) {
            $msg['success'] = 1;
            $msg['message'] = $message;
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }

    public function details() 
    {
        $userID = $this->Session->read('User.user_id');
        $roleId = $this->Session->read('User.role_id');
        $groupData = $this->Group->find('all',array('fields' => array('Group.id'),
            'conditions' => array('Group.user_id' => $userID)
            ));
        $id = $this->request->params['pass'][0];
        $getDetails = $this->People->getFamilyDetails($id);
        if ( $roleId  ==2 ) {
              $this->set('userId', $userID);
            $this->set('groupId', $id);
            $this->set('data', $getDetails);
            
        } else if( $roleId != 2 && in_array($id, $groupData[0]['Group'])) {
                     $this->set('userId', $userID);
            $this->set('groupId', $id);
            $this->set('data', $getDetails);
        } else {
            $this->redirect('/');
        }
    }

    public function familiyGroups() {


        $this->render('families');
    }

    public function getAjaxGroups() {
        $this->autoRender = false;
        $userID = $this->Session->read('User.user_id');
        $roleId = $this->Session->read('User.role_id');
        $data = $this->Group->getAllFamilyGroups($userID, $roleId);
        echo json_encode($data);
    }

    public function addSpouse() {

        $this->view('index');
    }

    public function buildTreeJson() {
        $this->autoRender = false;
        $this->layout = null;
        $groupId = $_REQUEST['gid'];
        $uid = $_REQUEST['uid'];

        $data = $this->People->getFamilyDetails($groupId);


//       echo '<pre>';
//        print_r($data);
//        exit;
        $rootId;
        $tree = array();
        foreach ($data as $key => $value) {
            $peopleData = $value['People'];
            
            if ( $peopleData['tree_level'] == "") {
                $rootId = $peopleData['id'];
                $peopleData['id'] = 'START';
                
            }
            if ($peopleData['tree_level'] != '') {
                if ( $peopleData['tree_level'] == $rootId) {
                    $tree[$peopleData['id']]['^'] = 'START';
                } else {
                    $tree[$peopleData['id']]['^'] = $peopleData['tree_level'];
                }
            } else {
                
            }
            //if ( $peopleData['tree_level'] == '') {
            $tree[$peopleData['id']]['n'] = $peopleData['first_name'] . ' ' . $peopleData['last_name'];
            $tree[$peopleData['id']]['ai'] = $peopleData['id'];

            $children = $this->People->getChildren($peopleData['id']);
            $childids = array();
            foreach ($children as $k => $v) {
                
                $childids[] = $v['People']['id'];
            }

            if (count($children)) {
                if ( $peopleData['tree_level'] == $rootId) {
                    
                }
                $tree[$peopleData['id']]['c'] = $childids;
                $tree[$peopleData['id']]['cp'] = true;
            } else {
                $tree[$peopleData['id']]['c'] = array();
                $tree[$peopleData['id']]['cp'] = false;
            }
            
            $tree[$peopleData['id']]['e'] = $peopleData['email'];
            $tree[$peopleData['id']]['u'] = $peopleData['phone_number'];
            
            $tree[$peopleData['id']]['f'] = $peopleData['f_id'];
            $tree[$peopleData['id']]['m'] = $peopleData['m_id'];
            $tree[$peopleData['id']]['fg'] = true;
            $tree[$peopleData['id']]['g'] = $peopleData['gender'] == 'male' ? 'm' : 'f';
            $tree[$peopleData['id']]['hp'] = true;
            $tree[$peopleData['id']]['i'] = $peopleData['id'];
            $tree[$peopleData['id']]['l'] = $peopleData['surname_now'];
            $tree[$peopleData['id']]['p'] = $peopleData['first_name'];
           
            if ( $peopleData['partner_id'] == $rootId) {
           
                if ($peopleData['partner_id'] != '' ) {
                $tree[$peopleData['id']]['pc'] = array(
                    'START' => true
                );
                $tree[$peopleData['id']]['es'] = 'START';
                $tree[$peopleData['id']]['s'] = 'START';
            }
            } else if( $peopleData['partner_id'] != '') {
                 $tree[$peopleData['id']]['pc'] = array(
                    $peopleData['partner_id'] => true
                );
                 $tree[$peopleData['id']]['es'] = $peopleData['partner_id'];
                 $tree[$peopleData['id']]['s'] = $peopleData['partner_id'];
            } else {
                $tree[$peopleData['id']]['pc'] = array();
                $tree[$peopleData['id']]['es'] = null;
            }
            $tree[$peopleData['id']]['q'] = $peopleData['surname_dob'];
            
            // }
        }
        
        echo json_encode($tree);
        exit;
    }
    
    public function addBusiness()
    {
        $userID = $this->Session->read('User.user_id');
        $states = $this->State->find('list', array('fields' => array('State.name', 'State.name')));
        $this->set(compact('states'));
       
        $pid = $_REQUEST['id'];
        $this->set('peopleid',$pid);
        $aid = $_REQUEST['aid'];
        
        $gid = $_REQUEST['gid'];
        
         $data = $this->People->find('all',array('fields' => array(
            'People.user_id','People.first_name','People.tree_level')
            ,'conditions'=> array(
                'People.group_id' => $gid,
                'People.id' => $pid,
                )));
         
         $array = array();
        $array['gid'] = $gid;
        
        $getOwnerDetails = $this->People->getParentPeopleDetails($array);
      
        $peopleData = $data[0]['People'];
        $this->set('show',$peopleData['tree_level'] == "" ? false : true);
        $getParentAddress = $this->Address->find('all',
                                    array(
                                            'conditions' => array(
                                                'Address.people_id' => $pid,
                                                'Address.id' => $aid
                                            )
                                        )
                                    );
        
        if( isset($getParentAddress[0]) && count($getParentAddress)) {
            $data = $getParentAddress[0]['Address'];
            foreach ( $data as $key => $value ) {
                $this->set($key,$value);
            }
        }
         $this->set('peopleid',$pid);
         $this->set('aid',$aid ? $aid : '');
         $this->set('name',$getOwnerDetails['first_name']);
          $this->set('parentid',$getOwnerDetails['id']);
          $this->set('parentaddressid',$getOwnerDetails['business_address_id']);
        
    }
    
    public function doProcessAddBusiness()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        
        $userID = $this->Session->read('User.user_id');
        $peopleId = $_REQUEST['peopleid'];
        $aid = $_REQUEST['addressid'];
        $same = $this->request->data['Address']['is_same'];
        $updatePeopleBusniessDetails = array();
        $updatePeopleBusniessDetails['id'] = $peopleId;
        $updatePeopleBusniessDetails['occupation'] = $this->request->data['occupation'];
        $updatePeopleBusniessDetails['business_name'] = $this->request->data['Address']['business_name'];
        
        $this->People->updateBusinessDetails($updatePeopleBusniessDetails);
        $parentId = $_REQUEST['parentid'];
        $paddressid = $_REQUEST['paddressid'];
        if ($same == 1) {
            if ( $this->Session->read('User.role_id') == 2) {
                $conditions = array('Address.id' => $paddressid);
            } else {
                 $conditions = array('Address.user_id' => $userID);
            }
            
            $getParentAddress = $this->Address->find('all',array('conditions' => $conditions));
            
            unset($getParentAddress[0]['Address']['id']);
            unset($getParentAddress[0]['Address']['people_id']);
            $getParentAddress[0]['Address']['created'] = date('Y-m-d H:i:s');
            $getParentAddress[0]['Address']['people_id'] = $_REQUEST['peopleid'];
            $this->request->data = $getParentAddress[0];
            if ($this->Address->save($this->request->data)) {
                $msg['status'] = 1;
                $addressId = $this->Address->id;
                $updatePeople = array();
                $updatePeople['People']['business_address_id'] = $addressId;
                $updatePeople['People']['id'] = $_REQUEST['peopleid'];
                $this->People->save($updatePeople);
                $message = 'Information has been saved';
            }
        } else {
            $getParentAddress = $this->Address->find('all', array(
                'conditions' => array(
                    'Address.people_id' => $peopleId,
                    'Address.id' => $aid
                )
                    )
            );

            if (isset($getParentAddress[0]) && count($getParentAddress)) {
                $this->request->data['Address']['id'] = $getParentAddress[0]['Address']['id'];
            }

            

            $this->request->data['Address']['people_id'] = $_REQUEST['peopleid'];
            if ($this->Address->save($this->request->data)) {
                $msg['status'] = 1;
                $addressId = $this->Address->id;
                $updatePeople = array();
                $updatePeople['People']['business_address_id'] = $addressId;
                $updatePeople['People']['id'] = $peopleId;

                $this->People->save($updatePeople);
                $message = 'Information has been saved';
            }
        }
        if ($msg['status'] == 1) {
            $msg['success'] = 1;
            $msg['message'] = $message;
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
    public function addAddress() {
        $userID = $this->Session->read('User.user_id');
        
         $states = $this->State->find('list', array('fields' => array('State.name', 'State.name')));
        $this->set(compact('states'));
        $pid = $_REQUEST['id'];
        $aid = $_REQUEST['aid'];        
        $gid = $_REQUEST['gid'];
        $getParentAddress = $this->Address->find('all',
                                    array(
                                            'conditions' => array(
                                                'Address.people_id' => $pid
                                            )
                                        )
                                   );
        
        $array = array();
        $array['gid'] = $gid;
        
        $getOwnerDetails = $this->People->getParentPeopleDetails($array);
        
        $array['pid'] = $pid;
        $data = $this->People->find('all',array('fields' => array(
            'People.user_id','People.first_name','People.tree_level')
            ,'conditions'=> array(
                'People.group_id' => $gid,
                'People.id' => $pid,
                )));
        
        
        $peopleData = $data[0]['People'];
        
        $this->set('show',$peopleData['tree_level'] == "" ? false : true);
        if( isset($getParentAddress[0]) && count($getParentAddress)) {
            $data = $getParentAddress[0]['Address'];
            foreach ( $data as $key => $value ) {
                $this->set($key,$value);
            }
        }
        
        $this->set('peopleid',$pid);
        $this->set('name',$getOwnerDetails['first_name']);
        $this->set('parentid',$getOwnerDetails['id']);
        $this->set('aid',$aid ? $aid : '');
        
    }
    
    public function doProcessAddress()
    {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $userID = $this->Session->read('User.user_id');
        $same = $this->request->data['Address']['is_same'];
        $parentId = $_REQUEST['parentid'];
        if ($same == 1) {            
            if ( $this->Session->read('User.role_id') == 2) {
                $conditions = array('Address.people_id' => $parentId);
            } else {
                 $conditions = array('Address.user_id' => $userID);
            }
            
            $getParentAddress = $this->Address->find('all',array('conditions' => $conditions));
            
            unset($getParentAddress[0]['Address']['id']);
            unset($getParentAddress[0]['Address']['people_id']);
            $getParentAddress[0]['Address']['created'] = date('Y-m-d H:i:s');
            $getParentAddress[0]['Address']['people_id'] = $_REQUEST['peopleid'];
            $this->request->data = $getParentAddress[0];
            if ($this->Address->save($this->request->data)) {
                $msg['status'] = 1;
                $addressId = $this->Address->id;
                $updatePeople = array();
                $updatePeople['People']['address_id'] = $addressId;
                $updatePeople['People']['id'] = $_REQUEST['peopleid'];
                $this->People->save($updatePeople);
                $message = 'Information has been saved';
            }            
        } else {
           
            $peopleId = $_REQUEST['peopleid'];        
            $getParentAddress = $this->Address->find('all',
                                                array(
                                                    'conditions' => array(
                                                        'Address.people_id' => $peopleId)
                                                    )
                                                );

        
            $this->request->data['Address']['user_id'] = $this->Session->read('User.user_id');
            $this->request->data['Address']['ownership_type'] = $_REQUEST['ownership_type'];
            $this->request->data['Address']['people_id'] = $_REQUEST['peopleid'];    
            $this->request->data['Address']['created'] = date('Y-m-d H:i:s');
            
            if( isset($getParentAddress[0]) && count($getParentAddress)) {
                 $this->request->data['Address']['id'] = $getParentAddress[0]['Address']['id'];
            } 
            
            $this->request->data['Address']['user_id'] = $this->Session->read('User.user_id');
            $this->request->data['Address']['ownership_type'] = $_REQUEST['ownership_type'];
                
            $this->request->data['Address']['created'] = date('Y-m-d H:i:s');
            
            
            if ($this->Address->save($this->request->data)) {
                $msg['status'] = 1;
                $addressId = $this->Address->id;
                $updatePeople = array();
                $updatePeople['People']['address_id'] = $addressId;
                $updatePeople['People']['id'] = $peopleId;
                $this->People->save($updatePeople);
                $message = 'Information has been saved';
            }
        }

        if ($msg['status'] == 1) {
            $msg['success'] = 1;
            $msg['message'] = $message;
        } else {
            $msg['success'] = 0;
            $msg['message'] = 'System Error, Please try again';
        }

        $this->set(compact('msg'));
        $this->render("/Elements/json_messages");
    }
    
    public function searchPeople()
    {
        $userID = $this->Session->read('User.user_id');
        
        $this->set('type',$_REQUEST['type']);
        $this->set('fid',$_REQUEST['fid']);
        $this->set('gid',$_REQUEST['gid']);
    }
    
    public function getAjaxSearch()
    { 
        $this->autoRender = false;
        
        $type = $_REQUEST['type'];
        
        $data = $this->People->getAllPeoples($type);
        echo json_encode($data);
        
        
    }
    
   

}
