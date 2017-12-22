<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('user_model');
//        $this->load->model('blog_model');
//        $this->load->model('badge_model');
//        $this->load->model('adventure_activites_model');
//        $this->load->model('photo_model');
        $this->load->model('common_model');
    }
    
    public function index() {
        $user_id = $this->input->get('user');
        if(!$user_id){
            $user_id = $this->session->userdata('id');
        }
        $data = array();
        $data['login_name'] = $this->session->userdata('name');
        //get user data from database by userid
        $user = $this->user_model->getuserById($user_id);
        if(empty($user)){
            $data['error_message'] = 'looks like somebody kidnapped this user, missing from system';
            $this->load->view('wrong_view.php', $data);
        }else{
            //creating user data for view page
            $data['user']['id'] = $user->id;
            $data['user']['name'] = $user->name;
            $data['user']['email'] = $user->email;
            $data['user']['phone'] = $user->phone;
            $data['user']['address1'] = $user->address1;
            $data['user']['address2'] = $user->address2;
            $data['user']['city'] = $user->city;
            $data['user']['state'] = $user->state;
            $data['user']['companyName'] = $user->companyName;
            $data['user']['photo'] = $user->photo;
            $data['user']['latitude'] = $user->latitude;
            $data['user']['longitude'] = $user->longitude;
           
            $this->load->view('header', $data);
            $this->load->view('sidebar', $data);
            $this->load->view('topnav', $data);
            $this->load->view('profile', $data);
            $this->load->view('footer');
        }
    }
}
?>
