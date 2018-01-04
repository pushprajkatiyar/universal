<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of ajax
 * Year 2015
 * @author Dharam veer
 */

class Ajax extends CI_Controller{
   
    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('url', 'html','cookie'));
        $this->load->library('session');
        $this->load->library('MY_PHPMailer');
        $this->load->model('user_model');
        $this->load->model("common_model");
        $this->load->model("device_model");
        $this->load->model("plant_model");
    }
    
    // Validate and login data in database
    public function login() {
        
        $post_data = $this->input->post();
       
        $result = $this->user_model->login($post_data['email'], $post_data['password']);
        
        $response_array = array();
        if(!$result){
            $response_array['message'] = "Email and password does not match";
            $response_array['redirect_url'] = '';
            $response_array['status'] = 0;
        }else{
            $res = $result[0];
            //creating cookies for remeber me 
            if(isset($post_data['uni_remember_me'])){
                $random_string =  base64_encode(time().uniqid());
                $cookie = array(
                        'name'   => 'uni_remember_me',
                        'value'  => $random_string,
                        'expire' => '1209600'  // Two weeks
                    );

                set_cookie($cookie);
//                $this->user_model->updateCookie($res->id, $random_string);
             }
            //cookei creation done 
            
            $response_array['message'] = "Login succesfull";
            $response_array['redirect_url'] = 'home';
            $sess_array = array(
                        'id'=>$res ->id,
                        'email'=> $res->email,
                        'plantId'=> $res->plant_id,
                        'currentPlantId'=> $res->plant_id,
                        'logged_in'=> TRUE,
                        'name'=>$res->name
                        );
            $response_array['status'] = 1;
            $this->session->set_userdata($sess_array);
        }
        die(json_encode($response_array));
    }
/*    
    // Validate and store registration data in database
    public function signup() {
//        $var = mkdir('img/users/161', 0777);
//        var_dump($var);
//        die;
        $post_data = array(
                        'name' => $this->input->post('user_name'),
                        'email' => trim($this->input->post('user_email')),
                        'password' => $this->input->post('user_password'),
                        'last_visit' => date("Y-m-d"),
                        'profile_image_id' => 1,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                        );
        
        $result = $this->user_model->registration_insert($post_data);
        //die(print_r($result));
        if(!$result){
            $response_array['message'] = "This email id is already registered!";
            $response_array['redirect_url'] = '';
            $response_array['status'] = 0;
        }else{
            $send_to = $post_data['email'];
            $message = 'Hello This is welcome massage for you from Trekoholic';
            $subject = 'Welcome to Trekoholic';
            $this->common_model->add_mail($send_to,$subject,$message);
            
            $user_id = $this->user_model->getLastuserById();
            mkdir("img/users/$user_id->id", 0777);
            
            $response_array['message'] = "Registration Successfull! Feel Free to Login.";
            $response_array['redirect_url'] = 'home';
            $response_array['status'] = 1;
        }
        die(json_encode($response_array));
    }
 */   
    public function logout(){
        //remove all session data
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        delete_cookie('remember_me');
        redirect(base_url('home'),'refresh');

        exit();
        no_cache();
    }
    
    function getGraphData(){
        $plant_id = $this->input->post('plant_id');
        $device_id = $this->input->post('device_id');
        //$date = date("Y-m-d H:i:s");
       $plant_attributes = $this->plant_model->getPlantAttributesByPlantId($this->session->userdata('plantId'));
       $columns ='reporting_datetime, ';
       $columns_array = array();
       
       foreach ($plant_attributes as $atrribute) {
           $columns .= $atrribute->history_col_name.",";
           $columns_array[] = $atrribute->history_col_name;
       }
       $columns = rtrim($columns, ",");
       //get graph data
       $device_history = $this->device_model->getRecentHistoryByDeviceId($device_id, $columns, 20);
       
       $flowrate_1 = array();
       $flowrate_2 = array();
       $label = array();
       foreach ($device_history as $history) {
         $flowrate_1[] = $history->flowrate_1;
         if(in_array("flowrate_2", $columns_array)){
             $flowrate_2[] = $history->flowrate_2;
         }
         $label[]= date("d-m H:i:s", strtotime($history->reporting_datetime));
       }
//       $flowrate_1 = rtrim($flowrate_1, ", ");
//       $flowrate_2 = rtrim($flowrate_2, ", ");
//       $label = rtrim($label, ", ");
       $response_array['graph_data']['flowrate_1'] = $flowrate_1;
       $response_array['graph_data']['flowrate_2'] = $flowrate_2;
       $response_array['graph_data']['label'] = $label;
       $response_array['message'] = "done";
       $response_array['status'] = 1;
                
       die(json_encode($response_array));
    }
    function updateEnq(){
        $enqid = $this->input->post('enqid');
        $comment = $this->input->post('comment');
        $toDept = $this->input->post('todept');
        $userid = $this->session->userdata('id');
        $date = date("Y-m-d H:i:s");

        $added = $this->comment_model->addComment($enqid, $userid, $comment, $date);
        $added = $this->enquiry_model->updateDept($enqid, $toDept, $userid);
        if($added){
            $message = "Updated Successfully";
        }  else {
            $message = "Failed, something is wrong !";
        }
        $response_array['message'] = $message;
        $response_array['status'] = $added;
        $response_array['redirect_url'] = "enquiry";
        
        die(json_encode($response_array));
    }
    
    function updateTour(){
        $enqid = $this->input->post('enqid');
        $comment = $this->input->post('comment');
        $toDept = $this->input->post('todept');
        $userid = $this->session->userdata('id');
        $date = date("Y-m-d H:i:s");

        $added = $this->comment_model->addComment($enqid, $userid, $comment, $date);
        $added = $this->enquiry_model->updateDept($enqid, $toDept, $userid);
        if($added){
            $message = "Updated Successfully";
        }  else {
            $message = "Failed, something is wrong !";
        }
        $response_array['message'] = $message;
        $response_array['status'] = $added;
        $response_array['redirect_url'] = "enquiry";
        
        die(json_encode($response_array));
    }
    
    function closeEnq(){
        $enqid = $this->input->post('id');
        $userid = $this->session->userdata('id');
        $username = $this->session->userdata('name');
        $date = date("Y-m-d H:i:s");
        $comment = "Booking closed by $username at $date";
        $added = $this->comment_model->addComment($enqid, $userid, $comment, $date);
        $closed = $this->enquiry_model->closeBooking($enqid);
        if($closed){
            $message = "Updated Successfully";
        }  else {
            $message = "Failed, something is wrong !";
        }
        $response_array['message'] = $message;
        $response_array['status'] = $added;
        $response_array['redirect_url'] = "enquiry";
        
        die(json_encode($response_array));
    }
}

?>
