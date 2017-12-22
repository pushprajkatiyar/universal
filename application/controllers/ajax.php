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
        $this->load->model("enquiry_model");
        $this->load->model("comment_model");
        $this->load->model("tour_model");
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
            if(isset($post_data['remember_me'])){
                $random_string =  base64_encode(time().uniqid());
                $cookie = array(
                        'name'   => 'remember_me',
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
                        'deptId'=> $res->deptId,
                        'userTypeId'=> $res->userTypeId,
                        'logged_in'=> TRUE,
                        'name'=>$res->name,
                        'profile_image_id'=>$res->photo
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
    
    function addquery(){
        $tourid = $this->input->post('tourid');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $touristCount = $this->input->post('number');
        $price = $this->input->post('price');
        $status = $this->input->post('paid');
        $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
        $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));
        
        $comment = $this->input->post('comment');
        
        $added_enq_id = $this->enquiry_model->addBooking($tourid,$name,$email,$phone,$touristCount,$start_date,$end_date,$price,$status, $comment);
        $date = date("Y-m-d H:i:s");
        $userid = $this->session->userdata('id');
        if($comment == ""){
            $username = $this->session->userdata('name');
            $comment = "Enquiry has been created by $username at $date";
        }
        $this->comment_model->addComment($added_enq_id, $userid, $comment, $date);        
        $sendmail = $this->input->post('sendemail');
        if($sendmail =="yes"){
            $message = "<h2>Tour Itinerary</h2>";
            $tourdata = $this->tour_model->getTourById($tourid);
            $message .= $tourdata->itinerary;
            $this->common_model->sendMail($email,"Your Booking With Travios Itinerary - Trav".$added_enq_id, $message);
        }
        if($added_enq_id){
            $message = "Added Successfully";
            $res_status = true;
        }  else {
            $res_status = false;
            $message = "Failed, something is wrong !";
        }
        $response_array['message'] = $message;
        $response_array['status'] = $res_status;
        $response_array['redirect_url'] = "enquiry";
        
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
