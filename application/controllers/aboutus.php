<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aboutus extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function index() {
//        $data['header']['form_action'] = "../search";
        if($this->session->userdata('id')){
            $this->load->model('photo_model');
            $image_object = $this->photo_model->getProfileImageByImageId($this->session->userdata('profile_image_id'));
            $image_thumb = $image_object->x_thumb_url;
            $data['user']['profile_image_thumb'] = $image_thumb;
        }
        
        $data['logged_in'] = ($this->session->userdata('id') != '') ? 1 : 0;
        
        $this->load->view('header_aboutus_view.php', $data);
        $this->load->view('aboutus_view.php');
        $this->load->view('footer_view.php');
    }
}
?>
