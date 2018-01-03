<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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

        $plant =  $this->plant_model->getPlantByPlantId($this->session->userdata('plantId'));
        $data['plant_attributes'] = $this->plant_model->getPlantAttributesByPlantId($this->session->userdata('plantId'));
        $devices = $this->device_model->getDevicesByPlantId($this->session->userdata('plantId'));
        $data['plants_devices'][$plant->id] = array("plant" => $plant, "devices" => $devices);
        $data['current_device'] = $devices['0']->device_id;
        
        $data['login_name'] = $this->session->userdata('name');
        $data['current_plant'] = $this->session->userdata('currentPlantId');
        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topnav', $data);
        $this->load->view('home', $data);
        $this->load->view('footer');
    }
}
?>