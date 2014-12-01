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
        'People', 'Village', 'Education', 'State', 'BloodGroup', 'Group');

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
    public function index() {

        $requestData = $this->request->data;
//echo '<pre>';
//    print_r($requestData);
//    exit;
        if ($requestData['type'] == 'self') {
            $userId = $this->Session->read('User.user_id');
            $toFetchData = true;
            $peopleId = $requestData['fid'];
        } else {
            $userId = '';
            $toFetchData = false;
            $peopleId = $requestData['fid'];
        }
        switch ($requestData['type']) {
            case 'addspouse':
                $pageTitle = 'Add Spouse';
                break;
            case 'addfather':
                $pageTitle = 'Add Father';
                break;
            case 'addmother':
                $pageTitle = 'Add Mother';
                break;
            default:
                $requestData['type'] = 'self';
                $pageTitle = 'Create your family - edit your Details';
                break;
        }
        $this->set('gid',$requestData['group_id']);
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
            $this->set('last_name', $getPeopleData['People']['last_name']);
            $this->set('phone_number', $getPeopleData['People']['phone_number'] ? $getPeopleData['People']['phone_number'] : $sessionData['phone_number'] );
            $this->set('email', $getPeopleData['People']['email']);
            $this->set('gender', $sessionData['gender']);
            $this->set('martial_status', $getPeopleData['People']['martial_status']);
            $this->set('surname_now', $getPeopleData['People']['surname_now']);
            $this->set('surname_dob', $getPeopleData['People']['surname_dob']);
            $this->set('state', $getPeopleData['People']['state']);
            $this->set('education', $getPeopleData['People']['education']);
            $this->set('village', $getPeopleData['People']['village']);
            $this->set('blood_group', $getPeopleData['People']['blood_group']);
        }
    }

    /**
     *  AJAX Callback - function to edit own details for creating tree
     */
    public function editOwnDetails() {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $userID = $this->Session->read('User.user_id');
        $data = $this->request->data['People'];
        if ($_REQUEST['peopleid'] != '') {
            $getPeopleDetail = $this->People->find('all', array('fields' => array('People.first_name',
                    'People.last_name', 'People.surname_now','People.group_id'),
                'conditions' => array('People.id' => $_REQUEST['peopleid']))
            );
           
        }
        switch ($_REQUEST['type']) {
            case 'addspouse':
                $this->request->data['People']['partner_id'] = $_REQUEST['peopleid'];
                $this->request->data['People']['tree_level'] = $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                
                $name = $getPeopleDetail[0]['People']['first_name'] . '' . $getPeopleDetail[0]['People']['lastname'];
                $this->request->data['People']['partner_name'] = $name;

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

                break;
            case 'addfather':

                $this->request->data['People']['tree_level'] = $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                if ($this->People->save($this->request->data)) {
                    $msg['status'] = 1;
                    $fatherId = $this->People->id;
                    $updateParentUser = array();
                    $updateParentUser['f_id'] = $fatherId;
                    $updateParentUser['father'] = $this->request->data['People']['first_name'];
                    $updateParentUser['id'] = $_REQUEST['peopleid'];
                    $this->People->updateFatherDetails($updateParentUser);
                      //check if mother exists in table for child
                    $getMotherDetails = $this->People->find('all', array('fields' => array('People.m_id','People.mother'),
                'conditions' => array('People.id' => $_REQUEST['peopleid']))
            );
                    
                    if(!empty($getMotherDetails[0]['People']['m_id'])) {
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

                break;
            case 'addmother':

                $this->request->data['People']['tree_level'] = $_REQUEST['peopleid'];
                $this->request->data['People']['group_id'] = $getPeopleDetail[0]['People']['group_id'];
                if ($this->People->save($this->request->data)) {
                    $msg['status'] = 1;
                    $motherId = $this->People->id;
                    $updateParentUser = array();
                    $updateParentUser['m_id'] = $motherId;
                    $updateParentUser['mother'] = $this->request->data['People']['first_name'];
                    $updateParentUser['id'] = $_REQUEST['peopleid'];
                    $this->People->updateMotherDetails($updateParentUser);                    
                    //check if father exists in table for child
                    $getFatherDetails = $this->People->find('all', array('fields' => array('People.f_id','People.father'),
                'conditions' => array('People.id' => $_REQUEST['peopleid']))
            );
                    if(!empty($getFatherDetails[0]['People']['f_id'])) {
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

                break;
            default:
                $checkExistingUser = $this->People->find('all', array('fields' => array('People.id'),
                    'conditions' => array('People.user_id' => $userID))
                );

                if (count($checkExistingUser)) {
                    $this->request->data['People']['id'] = $checkExistingUser[0]['People']['id'];
                    if ($this->People->save($this->request->data)) {
                        $msg['status'] = 1;
                    } else {
                        $msg['status'] = 0;
                    }
                }
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

    public function details() {
        $id = $_REQUEST['id'];
        $getDetails = $this->People->getFamilyDetails($id);
        $userID = $this->Session->read('User.user_id');
        $this->set('userId', $userID);
        $this->set('data', $getDetails);
    }

    public function familiyGroups() {


        $this->render('families');
    }

    public function getAjaxGroups() {
        $this->autoRender = false;
        $data = $this->Group->getAllFamilyGroups();
        echo json_encode($data);
    }

    public function addSpouse() {

        $this->view('index');
    }

}
