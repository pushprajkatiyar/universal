<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Enquiry extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('enquiry_model');
        $this->load->model('comment_model');
        $this->load->model('tour_model');

    }
    
    public function index() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $userid = $this->session->userdata('id');
        $usertype = $this->session->userdata('userTypeId');
        $data['isAgent'] = false;
        if($usertype == 2){
            $deptID = $this->session->userdata('deptId');
            $data['bookings'] = $this->enquiry_model->getBookingForEmp($deptID);
        }else{
            $data['bookings'] = $this->enquiry_model->getBookingForAgents($userid);   
            $data['isAgent'] = true;
        }
        $data['departments'] = $this->common_model->getAllDept();
        $data['login_name'] = $this->session->userdata('name');
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('enquiries', $data);
        $this->load->view('footer');
    }
    
    public function detail() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $id = $this->input->get('id');
        $data['login_name'] = $this->session->userdata('name');
        $data['booking'] = $this->enquiry_model->getBookingById($id);
        $data['comments'] = $this->comment_model->getcommentsByBookingId($id);
//        die(print_r($data));
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('enq_details', $data);
        $this->load->view('footer');
    }
    public function add() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $data['tours'] = $this->tour_model->getTours();
        $data['login_name'] = $this->session->userdata('name');
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('newenquiry', $data);
        $this->load->view('footer');
    }
}
?>	