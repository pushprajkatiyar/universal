<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cpcb extends CI_Controller {

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
        if(!$this->session->userdata('id') || $this->session->userdata('id') != 1){
            redirect(base_url('login'),'refresh');
        }

        
        $data = array();
        $all_plants = $this->plant_model->getAllPlants();            
        foreach ($all_plants as $plant) {
            $devices = array();
            $plant_attributes = $this->plant_model->getPlantAttributesByPlantId($plant['id']);
            $devices = $this->device_model->getDevicesByPlantId($plant['id']);
            $data['plants_devices'][$plant['id']] = array("plant" => $plant, "devices" => $devices, 'plant_attributes' => $plant_attributes);
        }        
        $data['login_name'] = $this->session->userdata('name');
        $this->load->view('header', $data);
        $this->load->view('sidebar_cpcb', $data);
        $this->load->view('topnav_cpcb', $data);
        $this->load->view('home_cpcb', $data);
        $this->load->view('footer');
    }
}
?>