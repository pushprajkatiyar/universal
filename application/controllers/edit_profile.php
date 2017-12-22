<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Edit_profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('adventure_activites_model');
        $this->load->model('common_model');
        $this->load->model('photo_model');
    }
    
    public function index() {
        if(!$this->session->userdata('id')){
           $data['error_message'] = 'You are not logged in !!';
           echo $this->load->view('wrong_view.php', $data, true);
           die;
        }
        $user_id = $this->session->userdata('id');
        $data = array();
        //get user data from database by userid
        $user = $this->user_model->getuserById($user_id);
//        die(print_r($user));
        if(empty($user)){
            $data['error_message'] = 'looks like somebody kidnapped you, missing from system. Contact support !';
            echo $this->load->view('wrong_view.php', $data, True);
            die();
        }
        
        //creating user data for view page
        $data['user']['id'] = $user->id;
        $data['user']['name'] = $user->name;
        $data['user']['email'] = $user->email;
        $data['user']['phone_no'] = $user->phone_no;
        $data['user']['dob'] = $user->dob;
        $data['user']['gender'] = $user->gender;
        $data['user']['description'] = $user->description;
        $data['user']['last_visit'] = floor((time() - strtotime($user->last_visit))/(60*60*24));//$user->last_visit;
        $data['user']['status'] = $user->status;
        $data['user']['kms_clocked'] = $user->kms_clocked;
        $data['user']['treks_done'] = $user->treks_done;
        $data['user']['activities_done'] = $this->common_model->repeated_key_array_to_no_key_array("id", json_decode(json_encode($this->adventure_activites_model->adventureActivitiesByUserId($user->id)), true));
        $data['user']['title'] = $user->title;
        $data['user']['trekpoints'] = $user->trekpoints;
        $data['user']['endrosmenst'] = $user->endorsement;
//        die(print_r($data));
        //getting profile picture
        $image_object = $this->photo_model->getProfileImageByImageId($user->profile_image_id);
        $image_thumb = $image_object->thumb_url;
        $image = $image_object->x_thumb_url;
        $data['user']['profile_image_thumb'] = $image_thumb;
        $data['user']['profile_image'] = $image;
        
        //profile image for header 
        $header_image_object = $this->photo_model->getProfileImageByImageId($this->session->userdata('profile_image_id'));
        $header_image_thumb = $header_image_object->x_thumb_url;          
        $data['user']['header_image_thumb'] = $header_image_thumb;
        
        //getting adventure activities
        $data['user']['adv_activities'] = $this->adventure_activites_model->getAllAdventureActivities();
        $data['user']['all_treking'] = $this->adventure_activites_model->getAllTreking();
        $data['user']['all_biking'] = $this->adventure_activites_model->getAllBiking();
        //die(print_r($data));
        //getting ticker data
        $data['user']['colorcombo'] = $this->getTickerColorAndQuote($data['user']['last_visit']);
//              die(print_r($data));
        $this->load->view('header_edit_profile_view', $data);
        $this->load->view('edit_profile_view.php',$data);
        $this->load->view('footer_view.php');
    }
    
    public function updateprofile(){
        if(!$this->session->userdata('id')){
            die('something wrong or you are not logged in');
        }
        $data = $this->input->post();
        //die(print_r($data));
        $activities = $this->input->post('activities');
        $activity = $this->getActivitiesBadges(count($activities));
        //die(print_r($activity));
        
        $name = $this->input->post('name');
        $phone_no = $this->input->post('phone_no');
        $description = $this->input->post('description');
        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $biking = $this->input->post('biking');
        $treks_done = $this->input->post('treks_done');
        //$activity = $this->getActivitiesBadges(count($this->input->post('activities')));
        
        $update_user_array = array();
        $update_user_array['name'] = $name;
        $update_user_array['phone_no'] = $phone_no;
        $update_user_array['description'] = $description;
        $update_user_array['dob'] = $dob;
        $update_user_array['gender'] = $gender;
        $update_user_array['kms_clocked'] = $biking;
        $update_user_array['treks_done'] = $treks_done;
        $update_user_array['updated_at'] = date("Y-m-d H:i:s");
        
        //die(print_r($update_user_array));
        $result = $this->user_model->updateUser($update_user_array, $this->session->userdata('id'));
        //die(print_r($result));
        if(!$result){
            $response_array['message'] = "Something went wrong, not able to update user data";
            $response_array['redirect_url'] = '';
            $response_array['status'] = 0;
        }else{
            $reslt = $this->user_model->insertActivities($activities, $this->session->userdata('id'));
            
            if($reslt){
                $response_array['message'] = "Update Activities Succesfull";
                $response_array['status'] = 1;
            }
            $res = $result[0];
            $response_array['biking'] = $biking;
            $response_array['treks_done'] = $treks_done;
            $response_array['activity'] = $activity;
            $response_array['message'] = "Update Succesfull";
            $response_array['status'] = 1;
            $response_array['redirect_url'] = 'profile';
        }
        die(json_encode($response_array));
    }
    
    public function updatelasttrip(){
        if(!$this->session->userdata('id')){
            die('something wrong or you are not logged in');
        }

        $date = str_replace("th", '', $this->input->post('date'));
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        
        $update_user_array = array();
        $update_user_array['last_visit'] = date("Y:m:d",strtotime($date."-".$month."-".$year));
        //die(print_r($update_user_array));
        $result = $this->user_model->updateUser($update_user_array, $this->session->userdata('id'));
        //die(print_r($result));
        if(!$result){
            
            $response_array['message'] = "Something went wrong, not able to update user data";
            $response_array['redirect_url'] = '';
            $response_array['status'] = 0;
        }else{
//            $res = $result[0];
            $this->common_model->updateTrekPoints($this->session->userdata('id'), 50);
            $response_array['message'] = "update succesfull";
            $response_array['status'] = 1;
            $response_array['redirect_url'] = 'profile';
        }
        die(json_encode($response_array));
    }
    
    public function uploaddp(){
        if(!$this->session->userdata('id')){
            die('something wrong or you are not logged in');
        }
        $response_array['message'] = "Something went wrong";
        $response_array['redirect_url'] = '';
        $response_array['status'] = 0;
        
        $ds          = DIRECTORY_SEPARATOR;  //1
        $storeFolder = '../../img/users/'.$this->session->userdata('id');   //2
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];          //3             
            $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
            $targetFile =  $targetPath. $_FILES['file']['name'];  //5
            
            move_uploaded_file($tempFile,$targetFile); //6
            $image_id = $this->common_model->uploadAndResize($targetFile, $this->session->userdata('id'));
            
            $update_user_array['profile_image_id'] = $image_id;
            $result = $this->user_model->updateUser($update_user_array, $this->session->userdata('id'));
            
            $newdata = array('profile_image_id'  => $image_id);

            $this->session->set_userdata($newdata);

            $response_array['message'] = "profile picture changed Successfully";
            $response_array['redirect_url'] = 'profile';
            $response_array['status'] = 1;
        }
        die(json_encode($response_array));
    }
    
    public function updatequote(){
        if(!$this->session->userdata('id')){
            die('something wrong or you are not logged in');
        }
        
        $quote = $this->input->post('quote');
        
        $update_user_array = array();
        $update_user_array['status'] = $quote;
        
        $result = $this->user_model->updateQuote($update_user_array, $this->session->userdata('id'));
        if(!$result){
            $response_array['message'] = "Something went wrong, not able to update user data";
            $response_array['redirect_url'] = '';
            $response_array['status'] = 0;
        }else{
            $res = $result[0];
            $response_array['message'] = "update succesfull";
            $response_array['status'] = 1;
            $response_array['redirect_url'] = 'profile';
        }
        die(json_encode($response_array));
    }
    
    private function getTickerColorAndQuote($day){
        //echo $day;
        $data = array();
        if($day==0){
            $data['color'] = "#0BAFA0";
            $data['quote'] = "jgdfbhgjkfd klgdf";
            $data['bottom'] = "#008a7d";
        } else {
            switch ($day) {
                case ($day < 1):
                        $data['color'] = "#0BAFA0";
                        $data['quote'] = "jgdfbhgjkfd klgdf";
                        $data['bottom'] = "#008a7d";
                    break;
                case $day < 30:
                        $data['color'] = "#0BAFA0";
                        $data['quote'] = "jgdfbhgjkfd klgdf";
                        $data['bottom'] = "#008a7d";
                    break;
                case $day < 61:
                        $data['color'] = "#FF6600";
                        $data['quote'] = "jgdfbhgjkfd klgdf";
                        $data['bottom'] = "#e44b01";
                    break;
                default:
                        $data['color'] = "#FF0000";
                        $data['quote'] = "jgdfbhgjkfd klgdf";
                        $data['bottom'] = "#c71111";
                    break;
            }
        }
        //die(print_r($data));
        return $data;
    }
    
    private function getActivitiesBadges($activity_count){
        switch ($activity_count) {
            case $activity_count >10:
                $image = "4";
                break;
            case $activity_count >= 4:
                $image = "3";
                break;
            case $activity_count >= 2:
                $image = "2";
                break;
            default:
                $image = "1";
                break;
        }
        return $image;
    }
}
?>
