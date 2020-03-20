<?php

namespace App\Controllers\Web;

use Quill\Factories\CoreFactory;
use Quill\Factories\ModelFactory;

class AdminController extends \App\Controllers\Web\AdminBaseController {

    function __construct($app = NULL) {

        parent::__construct($app);

        $this->models = ModelFactory::boot(array('Admin', 'User', 'Regions', 'Groups', 'Continents', 'Timezone', 'Sessions', 'SessionParticipants', 'Countries'));
        $this->core = CoreFactory::boot(array('View'));
    }

    /*
     *  Display login page view
     */

    public function dashboard() {

        // get all the active user in database
        $data['user_list'] = $this->models->user->getAvaiableUsers();

        // get all the active user in database
        $data['active_user_list'] = $this->models->user->getActiveUser();

        // get all the active user in database
        $data['inactive_user_list'] = $this->models->user->getInactiveUser();

        // get total session in databaase
        $data['total_session'] = $this->models->sessions->getTotalSessionDetail();

        // get upcoming session in database
        $data['upcoming_session'] = $this->models->sessions->getUpcomingDetail();
        
        // get missed session in databaase
        $data['missed_session'] = $this->models->sessions->getMissedSession();

        // get complete session in database
        $data['complete_session'] = $this->models->sessions->getSessionDetail(array('is_deleted' => '0', 'status' => 'complete'));

        // get upcoming 10 session 
        $data['latest_session'] = $this->models->sessions->getLatestSessionDetail();

        foreach ($data['latest_session'] as $key => $value) {
            $region = $this->models->regions->getRegionNameById($value['region_id']);
            $timezone = $this->models->timezone->getTimeZoneAbbrevationbyId($value['timezone_id']);
            $data['latest_session'][$key]['region_id'] = $region['region_name'];  // set the region name
            $data['latest_session'][$key]['date_time'] = date_time_format($value['date_time']);
            $data['latest_session'][$key]['created_at'] = date_time_format($value['created_at']);
        }

        $data['meta'] = array('title' => 'Dashboard', 'page_name' => 'Dashboard');

        $this->core->view->make('admin/dashboard.php', $data);
    }

    /*
     *  Display login page view
     */

    public function users() {

//        $data['rooms'] = $this->models->room->getRooms();

        $data['meta'] = array('title' => 'Users', 'page_name' => 'Users');

        $this->core->view->make('admin/users.php', $data);
    }

    /*
     *  Display vessel page view
     */

    public function createSession() {

        $data = array();
        // get all the continetns in database
        $data['continents'] = $this->models->continents->getContinents();

        // get all the regions in database
        $data['regions'] = $this->models->regions->getRegions();
        $region = array();
        foreach($data['regions'] as $r_key => $r_value){
            if(isset($region[$r_value['continent_id']])){
                $region[$r_value['continent_id']][$r_value['region_id']] = $r_value['region_name'];
            }else{
                $region[$r_value['continent_id']] = array($r_value['region_id'] => $r_value['region_name']);
            }
        }
        
        $data['regions'] = $region;
        
//        echo "<pre>" ;print_r($data['regions']);die;

        // all the timezone list
        $data['timezones'] = $this->models->timezone->getTimezone();

        // all the group list
        $data['groups'] = $this->models->groups->getGroups();
        
        $region_group = array();
        foreach($data['groups'] as $g_key => $g_value){
            if(isset($region_group[$g_value['region_id']])){
                $region_group[$g_value['region_id']][$g_value['group_id']] = $g_value['group_name'];
            }else{
                $region_group[$g_value['region_id']] = array($g_value['group_id'] => $g_value['group_name']);
            }
        }
        $data['groups'] = $region_group;
        
        // Get independent region
        $data['independentRegion'] = $this->models->regions->getIndependentRegion();

        $data['meta'] = array('title' => 'Create Session', 'page_name' => 'Create Session');

        $this->core->view->make('admin/createSession.php', $data);
    }

    /*
     *  Display upcoming session view
     */

    public function upcomingSessions() {

        $data = array();

        // get all the continetns in database
        $data['continents'] = $this->models->continents->getContinents();

        // get all the regions in database
        $data['regions'] = $this->models->regions->getRegions();
        $region = array();
        foreach($data['regions'] as $r_key => $r_value){
            if(isset($region[$r_value['continent_id']])){
                $region[$r_value['continent_id']][$r_value['region_id']] = $r_value['region_name'];
            }else{
                $region[$r_value['continent_id']] = array($r_value['region_id'] => $r_value['region_name']);
            }
        }
        $data['regions'] = $region;
        
//        echo "<pre>" ;print_r($data['regions']);die;

        // all the timezone list
        $data['timezones'] = $this->models->timezone->getTimezone();

        // all the group list
        $data['groups'] = $this->models->groups->getGroups();
        
        // Get independent region
        $data['independentRegion'] = $this->models->regions->getIndependentRegion();
        
        $region_group = array();
        foreach($data['groups'] as $g_key => $g_value){
            if(isset($region_group[$g_value['region_id']])){
                $region_group[$g_value['region_id']][$g_value['group_id']] = $g_value['group_name'];
            }else{
                $region_group[$g_value['region_id']] = array($g_value['group_id'] => $g_value['group_name']);
            }
        }
        $data['groups'] = $region_group;

        $data['meta'] = array('title' => 'Upcoming Sessions', 'page_name' => 'Upcoming Sessions');

        $this->core->view->make('admin/upcomingSession.php', $data);
    }

    /*
     *  Display complete session view
     */

    public function completeSessions() {

        $data = array();

        $data['meta'] = array('title' => 'Complete Sessions', 'page_name' => 'Complete Sessions');

        $this->core->view->make('admin/completedSession.php', $data);
    }

    /*
     *  Create group for regions
     */

    public function createGroup() {

        $data = array();
        // get all the continetns in database
        $data['continents'] = $this->models->continents->getContinents();

        // get all the regions in database
        $data['regions'] = $this->models->regions->getRegions();

        // all the timezone list
        $data['timezones'] = $this->models->timezone->getTimezone();

        $data['meta'] = array('title' => 'Create Group', 'page_name' => 'create_group');

        $this->core->view->make('admin/createGroup.php', $data);
    }

    /*
     *  view region list
     */

    public function regionList() {

        $data = array();
        // get all the continetns in database
        $data['continents'] = $this->models->continents->getContinents();
        
        // get all the regions in database
        $data['regions'] = $this->models->regions->getRegions();
        
//        echo '<pre>';print_r($data['regions']);die;
        
        // Get independent region
        $data['independentRegion'] = $this->models->regions->getIndependentRegion();

        // all the timezone list
        $data['timezones'] = $this->models->timezone->getTimezone();

        // all the group list
        $data['groups'] = $this->models->groups->getGroups();
        
        // all the group list of independent
        $data['groupsOfIndenpendentRegion'] = $this->models->groups->getGroupsOfIndenpendentRegion($data['independentRegion']['region_id']);
      
        $region_group = array();
        foreach($data['groups'] as $g_key => $g_value){
            if(isset($region_group[$g_value['region_id']])){
                $region_group[$g_value['region_id']][$g_value['group_id']] = $g_value['group_name'];
            }else{
                $region_group[$g_value['region_id']] = array($g_value['group_id'] => $g_value['group_name']);
            }
        }
        $data['groups'] = $region_group;

        $data['meta'] = array('title' => 'Region List', 'page_name' => 'regions');

        $this->core->view->make('admin/regions.php', $data);
    }

    /*
     *  Display Missed session view
     */

    public function missedSessions() {

        $data = array();

        $data['meta'] = array('title' => 'Missed Sessions', 'page_name' => 'Missed Sessions');

        $this->core->view->make('admin/missedSession.php', $data);
    }

    /*
     *  Display participant view
     */

    public function viewParticipants($id) {

        $data = array();
        // get session participants info
        $session_data = $this->models->sessionParticipants->getParticipantBySessionId($id);

        // check moderator
        //$data['is_moderator_set'] = $this->models->sessionParticipants->getmoderatorDeatilBySessionId($id);

        // get session detail

        $session_detail = $this->models->sessions->getSessionDetailById($id);

        $user_data = array();
        foreach ($session_data as $s_key => $s_value) {// get all the user details
            $user_detail = $this->models->user->geUserDetailById($s_value['user_id']);
            if (!empty($user_detail)) {
                $country_detail = $this->models->countries->getCountryNameById($user_detail['phone_code']);
                $user_detail['phone_code'] = $country_detail['phone_code'];

                if ($user_detail['status'] == '1' && $user_detail['is_deleted'] == '0') { // user is active or not deleted
                    $user_data[$s_value['participant_id']] = $user_detail;
                }
            }
        }

        $data['session_id'] = $id;

        $data['user_data'] = $user_data;

        $data['session_name'] = $session_detail['title'];

        $data['meta'] = array('title' => 'Participants', 'page_name' => 'Participants');

        $this->core->view->make('admin/viewParticipants.php', $data);
    }

    /*
     *  Display missed participant view
     */

    public function viewMissedParticipants($id) {

        $data = array();
        // get session participants info
        $session_data = $this->models->sessionParticipants->getParticipantBySessionId($id);

        // check moderator
        $data['is_moderator_set'] = $this->models->sessionParticipants->getmoderatorDeatilBySessionId($id);

        // get session detail

        $session_detail = $this->models->sessions->getSessionDetailById($id);

        $user_data = array();
        foreach ($session_data as $s_key => $s_value) {// get all the user details
            $user_detail = $this->models->user->geUserDetailById($s_value['user_id']);
            if (!empty($user_detail)) {
                $country_detail = $this->models->countries->getCountryNameById($user_detail['phone_code']);
                $user_detail['phone_code'] = $country_detail['phone_code'];

                if ($user_detail['status'] == '1' && $user_detail['is_deleted'] == '0') { // user is active or not deleted
                    $user_data[$s_value['participant_id']] = $user_detail;
                }
            }
        }

        $data['session_id'] = $id;

        $data['user_data'] = $user_data;

        $data['session_name'] = $session_detail['title'];

        $data['meta'] = array('title' => 'Missed Participants', 'page_name' => 'Missed Participants');

        $this->core->view->make('admin/viewMissedParticipants.php', $data);
    }

    /*
     *  Display session page view
     */

    public function session($id) {
        $data = array();
        // get session participants info
        $session_data = $this->models->sessionParticipants->getParticipantBySessionId($id);

        // get session detail
        $session_detail = $this->models->sessions->getSessionDetailById($id);

        $user_data = array();
        foreach ($session_data as $s_key => $s_value) {// get all the user details
            $user_detail = $this->models->user->geUserDetailById($s_value['user_id']);
            if (!empty($user_detail)) {
                $country_detail = $this->models->countries->getCountryNameById($user_detail['phone_code']);
                $user_detail['phone_code'] = $country_detail['phone_code'];

                if ($user_detail['status'] == '1' && $user_detail['is_deleted'] == '0') { // user is active or not deleted
                    $user_data[$s_value['participant_id']] = $user_detail;
                }
            }
        }

        // check chat exits
        $file_name = $this->app->config('file_upload_path') . 'uploads/chats/' . $session_detail['tokbox_session_id'] . '.txt';

        if (!empty($session_detail['tokbox_session_id'])) { // tokbox session id exist
            if (file_exists($file_name)) { // if file exist retrive previous chat
                $file_content = file_get_contents($file_name);
                if (!empty($file_content)) { // file has content
                    $file_content = json_decode($file_content, true);
                    $data['previous_chat'] = $file_content;
                }
            }
        }

        if (!empty($session_detail['archive_url'])) {  // url present
            $data['archive_url'] = $session_detail['archive_url'];
        }

        $data['session_name'] = $session_detail['title'];

        $data['session_users'] = $user_data;

        $data['meta'] = array('title' => 'Session', 'page_name' => 'session');

        $this->core->view->make('admin/session.php', $data);
    }

}
