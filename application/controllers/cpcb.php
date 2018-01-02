<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cpcb extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('enquiry_model');
    }
    
    public function index() {
        if(!$this->session->userdata('id') || $this->session->userdata('id') != 1){
            redirect(base_url('login'),'refresh');
        }
        
        $data = array();
        $data['login_name'] = $this->session->userdata('name');
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('home', $data);
        $this->load->view('footer');
    }
}
?>