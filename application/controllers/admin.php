<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('common_model');
        $this->load->model('plant_model');
        $this->load->model('device_model');
    }
    
    public function index() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();

        $allplants = $this->plant_model->getAllPlants();
        $response = array();
        foreach ($allplants as $plant){
            
            $response[$plant['id']]['plant'] = $plant;
            $response[$plant['id']]['device'] = $this->device_model->getDevicesByPlantId($plant['id']);
        }
        
        $data['login_name'] = $this->session->userdata('name');
        $data['current_plant'] = $this->session->userdata('currentPlantId');
        $data['plants'] = $response;
        $this->load->view('header', $data);
        $this->load->view('sidebar-admin', $data);
        $this->load->view('topnav-admin', $data);
        $this->load->view('admin', $data);
        $this->load->view('footer');
    }
    
    public function add() {
        if(!$this->session->userdata('id')){
            redirect(base_url('login'),'refresh');
        }
        $data = array();
        $data['attributes'] = $this->common_model->getAllAttr();
        
        $data['login_name'] = $this->session->userdata('name');
        $data['current_plant'] = $this->session->userdata('currentPlantId');
        $this->load->view('header', $data);
        $this->load->view('sidebar-admin', $data);
        $this->load->view('topnav-admin', $data);
        $this->load->view('admin_add_device', $data);
        $this->load->view('footer');
    }
}
?>