<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plant_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // Read data from database to show data in admin page
    public function getPlantByPlantId($plant_id) {

        $condition = "id =" . "'" . $plant_id . "'";
        $this->db->select('id, name, address, phone, email, lat, lng, description, zip, city, state');
        $this->db->from('plant');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result =  $query->result();
            return $result[0];
        } else {
            return array();
        }
    }
    // Read data from database to show data in admin page
    public function getPlantAttributesByPlantId($plant_id) {

        $condition = "plant_id =" . "'" . $plant_id . "'";
        $this->db->select('name, history_col_name, unit, para_limit');
        $this->db->from('xref_plant_attribute');
        $this->db->join('attributes', 'attributes.id = xref_plant_attribute.attribute_id');
        $this->db->where($condition);
        $this->db->where("active", 1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function vendor_update($email,$password,$fname,$lname,$phone,$website,$rating,$description,$vendor_id) {
        
        $vendor_update['email'] = $email;
        $vendor_update['password'] = $password;
        $vendor_update['firstname'] = $fname;
        $vendor_update['lastname'] = $lname;
        $vendor_update['phone'] = $phone;
        $vendor_update['website'] = $website;
        $vendor_update['rating'] = $rating;
        $vendor_update['description'] = $description;
        $vendor_update['updated_at'] = date("Y-m-d H:i:s");

        // Query to insert data in database
        $this->db->update('vendor', $vendor_update, array('id' => $vendor_id));
        //$this->db->where('id', $vendor_id);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function vendor_image_update($targetFile, $vendor_id){
            $this->load->library('image_lib');
            
            //creating thumb_url
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $targetFile;
            //$config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = true;
            $config2['width']     = 1000;
            $config2['height']   = 1000;
            $config2['new_image'] = "thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            //die(print_r($config2));
            
//            $data['email'] = $email;
//            $data['password'] = $password;
//            $data['name'] = $name;
//            $data['phone'] = $phone;
//            $data['website'] = $website;
//            $data['rating'] = $rating;
//            $data['description'] = $description;
            //$data['trek_id'] = $trek_id;
            //$data['full_image_url'] = ($trek_id) ? "img/trek/".$_FILES['file']['name'] : "img/trek/thumb/".$_FILES['file']['name'];
            //$data['x_thumb_url'] = ($trek_id) ? "img/trek/".$config1['new_image'] : "img/trek/thumb/".$config1['new_image'];
            $data['image_url'] = ($vendor_id) ? "img/vendor/".$config2['new_image'] : "img/vendor/".$config2['new_image'];
            $data['updated_at'] = date("Y-m-d H:i:s");
            
            //$data['title'] = $_FILES['file']['name'];
            //die(print_r($data));
            $res = $this->db->update('vendor', $data, array('id' => $vendor_id));
            if($res){
                return true;
            }
            return 0;
    }
    
    public function uploadHomeImageAndResize($targetFile, $home_id, $quote_head, $quote_content){
            $this->load->library('image_lib');
            
            //creating full_image
            /*
            $config['image_library'] = 'gd2';
            //$config1['create_thumb'] = TRUE;
            $config['source_image'] = $targetFile;
            $config['maintain_ratio'] = true;
            $config['width']     = 1000;
            $config['height']   = 1000;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            
            $data['id'] = $home_id;
            $data['quote_head'] = $quote_head;
            $data['quote_content'] = $quote_content;
            $data['image_url'] = ($home_id) ? "img/home/".$_FILES['file']['name'] : "img/home/".$_FILES['file']['name'];
            //$data['x_thumb_url'] = ($trek_id) ? "img/trek/".$config1['new_image'] : "img/trek/thumb/".$config1['new_image'];
            //$data['image_url'] = ($trek_id) ? "img/trek/thumb/".$config2['new_image'] : "img/trek/thumb/".$config2['new_image'];
            //$data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            
            //$data['title'] = $_FILES['file']['name'];
            //die(print_r($data));
             * 
             */
            $data['quote_head'] = $quote_head;
            $data['quote_content'] = $quote_content;
            $data['image_url'] = "img/home/".$_FILES['file']['name'];
            $data['updated_at'] = date("Y-m-d H:i:s");
            
            $res = $this->db->update('landing_image', $data, array('id' => $home_id));
            if($res){
                return true;
            }
            return 0;
    }
    
    public function plant_reg($post_data) {

        // Query to check whether username already exist or not
        $condition = "email =" . "'" . $post_data['email'] . "'";
        $this->db->select('*');
        $this->db->from('plant');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
        // Query to insert data in database
            $this->db->insert('plant', $post_data);
            if ($this->db->affected_rows() > 0) {
                return $this->db->insert_id();
            }
        } else {
            return false;
        }
    }
    
    function getAllPlants(){
        $this->db->select('*');
        $this->db->from('plant');        
        $query = $this->db->get();
        
        return $query->result_array();                
    }
    
    public function uploadVendorImageAndResize($targetFile, $vendor_id){
            $this->load->library('image_lib');
            
            //creating thumb_url
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $targetFile;
            //$config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = true;
            $config2['width']     = 1000;
            $config2['height']   = 1000;
            $config2['new_image'] = "thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            //die(print_r($config2));
            
            $data['vendor_id'] = $vendor_id;
            //$data['full_image_url'] = ($trek_id) ? "img/trek/".$_FILES['file']['name'] : "img/trek/thumb/".$_FILES['file']['name'];
            //$data['x_thumb_url'] = ($trek_id) ? "img/trek/".$config1['new_image'] : "img/trek/thumb/".$config1['new_image'];
            $data['image_url'] = ($vendor_id) ? "img/vendor/thumb/".$config2['new_image'] : "img/vendor/thumb/".$config2['new_image'];
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            
            //$data['title'] = $_FILES['file']['name'];
            //die(print_r($data));
            $res = $this->db->insert('vendor_image_slider', $data);
            if($res){
                return true;
            }
            return 0;
    }
    
    public function addtrektalk($targetFile,$name,$place,$type){
            $this->load->library('image_lib');
            
            //creating thumb_url
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $targetFile;
            //$config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = true;
            $config2['width']     = 270;
            $config2['height']   = 270;
            $config2['new_image'] = "thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            //die(print_r($config2));
            
//            $data['email'] = $email;
//            $data['password'] = $password;
            $data['name'] = $name;
            $data['place'] = $place;
            $data['type_id'] = $type;
//            $data['rating'] = $rating;
//            $data['description'] = $description;
            //$data['trek_id'] = $trek_id;
            //$data['full_image_url'] = ($trek_id) ? "img/trek/".$_FILES['file']['name'] : "img/trek/thumb/".$_FILES['file']['name'];
            //$data['x_thumb_url'] = ($trek_id) ? "img/trek/".$config1['new_image'] : "img/trek/thumb/".$config1['new_image'];
            $data['image_url'] = "img/trektalk/".$config2['new_image'];
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            
            //$data['title'] = $_FILES['file']['name'];
            //die(print_r($data));
            $res = $this->db->insert('forum_topic', $data);
            if($res){
                return true;
            }
            return 0;
    }
    
    // Read data from database to show data in admin page
    public function getTrektalkById($trektalk_id) {

        $condition = "id =" . "'" . $trektalk_id . "'";
        $this->db->select('id, image_url');
        $this->db->from('forum_topic');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result =  $query->result();
            return $result[0];
        } else {
            return array();
        }
    }
    
    public function trektalk_image_update($targetFile, $trektalk_id){
            $this->load->library('image_lib');
            
            //creating thumb_url
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $targetFile;
            //$config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = true;
            $config2['width']     = 270;
            $config2['height']   = 270;
            $config2['new_image'] = "thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            //die(print_r($config2));
            
            $data['image_url'] = ($trektalk_id) ? "img/trektalk/".$config2['new_image'] : "img/trektalk/".$config2['new_image'];
            $data['updated_at'] = date("Y-m-d H:i:s");
            //$data['title'] = $_FILES['file']['name'];
            $res = $this->db->update('forum_topic', $data, array('id' => $trektalk_id));
            if($res){
                return true;
            }
            return 0;
    }
    
    function deleteVendorSlideImageById($id){
        $this->db->where('id', $id);
        $this->db->delete('vendor_image_slider');
        return true;
    }
    
    function deleteTrekSlideImageById($id){
        $this->db->where('id', $id);
        if($this->db->delete('trek_image_slider')){
            return true;
        }
        return false;
    }
}
?>