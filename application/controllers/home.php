<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $data['login_name'] = $this->session->userdata('name');
        $data['total_enq'] = $this->enquiry_model->getBookingCounts();
        $data['today_enq'] = $this->enquiry_model->getBookingCounts(true);
        $graphdata = $this->enquiry_model->getGraphData();
        $data['graph']['axis'] = $this->common_model->repeated_key_array_to_no_key_array("day", $graphdata);
        $data['graph']['value'] = $this->common_model->repeated_key_array_to_no_key_array("sum", $graphdata);
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('home', $data);
        $this->load->view('footer');
    }
}
?>