<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contactus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('session');
    }
    
    public function index() {
        if($this->session->userdata('id')){
            $this->load->model('photo_model');
            $image_object = $this->photo_model->getProfileImageByImageId($this->session->userdata('profile_image_id'));
            $image_thumb = $image_object->x_thumb_url;
            $data['user']['profile_image_thumb'] = $image_thumb;
        }
        
        $data['logged_in'] = ($this->session->userdata('id') != '') ? 1 : 0;
        
        $this->load->view('header_contactus_view.php', $data);
        $this->load->view('contactus_view.php');
        $this->load->view('footer_view.php');
    }
    
    public function contact_form(){
        $post_data = array(
                'name' => $this->input->post('title'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'message' => $this->input->post('description')
            );
        
        $result = $this->send_email($post_data);
        
        if($result){
            $response_array['message'] = "Your Query has been submitted, We will contact you soon.";
            $response_array['redirect_url'] = 'contactus';
            $response_array['status'] = 1;
        } else {
            $response_array['message'] = "We are unable to process.Please try later..!";
            $response_array['redirect_url'] = '';
            $response_array['status'] = 0;
        }
        die(json_encode($response_array));
    }
    
    public function send_email($post_data){
        //die(print_r($post_data));
        
        $subject = "".$post_data['name']." Contat Us | Trekoholic";
        $name = $post_data['name'];
        $email = $post_data['email'];
        $phone = $post_data['phone'];
        $message = $post_data['message'];
        $body = "<html>
                    <body style ='background: none repeat scroll 0 0 #021029;color: #ffffff;padding: 20px'>
                        <div style='border-radius: 6px;margin: 10px' ></div>
                        <div style ='background: none repeat scroll 0 0 #B4B5B6;border-radius: 8px;box-shadow: 0 1px 6px #999999;padding : 20px' >
                            <b>Name:-</b>  $name<br/><br/>
                            <b>Email:-</b>  $email<br/><br/>
                            <b>Contact No:-</b>  $phone<br/><br/>
                            <b>Message:-</b>  $message<br/><br/>
                        </div>
                    </body>
                </html>";

        $this->email->from("dv.singh0088@gmail.com", "Trekoholic");
//            $this->email->reply_to("info@doh.com", "Drop Of Hopes");    // Optional, an account where a human being reads.
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($body);
        if($this->email->send()){
            
            return TRUE;
        } else {
            
            echo $this->email->print_debugger();
            return FALSE;
        }
    }
}
?>
