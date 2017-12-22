<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tours extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('tour_model');

    }
    
    public function index() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $data['login_name'] = $this->session->userdata('name');
        $data['tours'] = $this->tour_model->getTours();
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('tours', $data);
        $this->load->view('footer');
    }
    
    
    public function edit() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $data['login_name'] = $this->session->userdata('name');
        $tourid = $this->input->get('id');
        $data['tour'] = $this->tour_model->getTourById($tourid);
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('tour_edit', $data);
        $this->load->view('footer');
    }
}
?>