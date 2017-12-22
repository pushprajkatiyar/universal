<?php
/*
 * Description of writearticle
 *
 * @author PR KATIYAR
 */
class Knowhows extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->_ci =& get_instance();
        $this->load->helper(array('form','html'));
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('knowhows_model');
        $this->load->model('common_model');
    }
    
    public function index(){
        $knowhow_id = $this->input->get('knowhow');
        if(!$knowhow_id){
            die("something went wrong, might be tempored URL");
        }
        $current_knowhow = $this->knowhows_model->knowhowByid($knowhow_id);
        
        $knowhows = $this->knowhows_model->knowhowsByPaging();
        //die(print_r($knowhows));
        $knowhows_array = array();
        $i =0;
        foreach ($knowhows as $knowhow) {
            $knowhows_array[$i]['id'] = $knowhow->id;
            $knowhows_array[$i]['title'] = $knowhow->title;
            $knowhows_array[$i]['description'] = $knowhow->description;    
            $knowhows_array[$i]['image_url'] = $knowhow->image_url;
            $knowhows_array[$i]['thumb_url'] = $knowhow->thumb_url;
            $knowhows_array[$i]['created_at'] = $this->common_model->humanTiming(strtotime($knowhow->created_at));
            $i++;
        }
        $data['knowhows'] = $knowhows_array;
        $data['current_knowhow'] = $current_knowhow;
        $data['created_at'] = $this->common_model->humanTiming(strtotime($current_knowhow->created_at));
        //die(print_r($data));
        
        if($this->session->userdata('id')){
            $this->load->model('photo_model');
            $image_object = $this->photo_model->getProfileImageByImageId($this->session->userdata('profile_image_id'));
            $image_thumb = $image_object->x_thumb_url;
            $data['user']['profile_image_thumb'] = $image_thumb;
        }
        
        $data['header']['form_action'] = "../search";
        $this->load->view('header_gallery_view.php', $data);
        $this->load->view('knowhows_view.php', $data);
        $this->load->view('footer_view.php');
    }
}
?>
