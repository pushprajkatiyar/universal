<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
    }
    
    public function index() {
//        $this->load->view('error_header');
        $this->load->view('error_view.php');
    }
}
?>