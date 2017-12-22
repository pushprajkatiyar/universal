<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
 
    }
 
    function get_treks() {
        
        $this->db->select('difficulty.id as id, difficulty.name as d_name,
            region.id as id, region.name as r_name, mountains.id as id, mountains.name as m_name,
            trek.id as id, trek.title as title, trek.description as description, trek.rating as rating,
            trek.country as country, trek.created_at as created_at');
        $this->db->from('trek');
        $this->db->join('difficulty', 'difficulty.id = trek.difficulty_id');
        $this->db->join('region', 'region.id = trek.region');
        $this->db->join('mountains', 'mountains.id = trek.mountain_id');
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
         
    function insert_treks($data) {
        
        $this->db->insert('trek', $data);
        return $this->db->insert_id();
    }
    
    function deleteTrekById($id){
        $this->db->where('id', $id);
        if($this->db->delete('trek')){
            return true;
        }
        return false;
    }
    
    function get_trek_image($trek_id){
        $this->db->select('trek_image_slider.id as id, trek_image_slider.trek_id as trek_id,
            trek_image_slider.image_url as image_url');
        $this->db->from('trek_image_slider');
        $this->db->where('trek_id', $trek_id);
        
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }        
    }
    
    public function uploadTrekImageAndResize($targetFile, $trek_id){
            $this->load->library('image_lib');
            
            //creating full_image
            
//            $config['image_library'] = 'gd2';
//            //$config1['create_thumb'] = TRUE;
//            $config['source_image'] = $targetFile;
//            $config['maintain_ratio'] = true;
//            $config['width']     = 800;
//            $config['height']   = 800;
//
//            $this->image_lib->clear();
//            $this->image_lib->initialize($config);
//            $this->image_lib->resize();
//            $this->image_lib->clear();

            //creating x_thumb 
            
//            $config1['image_library'] = 'gd2';
//            $config1['source_image'] = $targetFile;
//            //$config1['create_thumb'] = TRUE;
//            $config1['maintain_ratio'] = true;
//            $config1['width']     = 400;
//            $config1['height']   = 400;
//            $config1['new_image'] = "x_thumb_".$_FILES['file']['name'];
//            $this->image_lib->clear();
//            $this->image_lib->initialize($config1);
//            $this->image_lib->resize();
            
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
            
            $data['trek_id'] = $trek_id;
            //$data['full_image_url'] = ($trek_id) ? "img/trek/".$_FILES['file']['name'] : "img/trek/thumb/".$_FILES['file']['name'];
            //$data['x_thumb_url'] = ($trek_id) ? "img/trek/".$config1['new_image'] : "img/trek/thumb/".$config1['new_image'];
            $data['image_url'] = ($trek_id) ? "img/trek/thumb/".$config2['new_image'] : "img/trek/thumb/".$config2['new_image'];
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            
            //$data['title'] = $_FILES['file']['name'];
            //die(print_r($data));
            $res = $this->db->insert('trek_image_slider', $data);
            if($res){
                return true;
            }
            return 0;
    }
    
    
    function get_offered_treks() {
        
        $this->db->select('trek.id as id, trek.title as title, vendor.id as id, vendor.email as email,
            offered_trek.id as id, offered_trek.description as description, offered_trek.start_date as start_date,
            offered_trek.end_date as end_date, offered_trek.cost as cost, offered_trek.created_at as created_at, offered_trek.status as status');
        $this->db->from('offered_trek');
        $this->db->join('trek', 'trek.id = offered_trek.trek_id');
        $this->db->join('vendor', 'vendor.id = offered_trek.vendor_id');
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
 
    function insert_offered_treks($data) {
        $this->db->insert('offered_trek', $data);
        return $this->db->insert_id();
    }
    
    function insert_trekoffering_attraction($id) {
        $data['trek_offering_id'] = $id;
        $data['created_at'] = date("Y-m-d H:i:s");
        //die(print_r($data));
        if($this->db->insert('xref_trekoffering_attraction', $data)){
            return true;
        }  else {
            return false;
        }
    }
    
    function deleteOfferedTrekById($id){
        $this->db->where('id', $id);
        if($this->db->delete('offered_trek')){
            return true;
        }
        return false;
    }
    
    function removeTrekById($trek_id){
        $this->db->set('status', '0');
        $this->db->where('id', $trek_id);
        if($this->db->update('offered_trek')){
            return true;
        }
        return false;
    }
    
    function addTrekById($trek_id){
        $this->db->set('status', '1');
        $this->db->where('id', $trek_id);
        if($this->db->update('offered_trek')){
            return true;
        }
        return false;
    }
    
    function get_vendors() {
        $this->db->select('*');
        $this->db->from('vendor');
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }
 
    function insert_vendors($data) {
        $this->db->insert('vendor', $data);
        return $this->db->insert_id();
    }
    
    function deleteVendorById($id){
        $this->db->where('id', $id);
        if($this->db->delete('vendor')){
            return true;
        }
        return false;
    }
    
    // Get knowshow data in database
    function get_knowshow() {
        
        $this->db->select('images.id as id, images.full_image_url as full_image_url, 
            knows_how.id as id, knows_how.title as title, knows_how.created_at as created_at,
            knows_how.description as description');
        $this->db->from('knows_how');
        $this->db->join('images', 'images.id = knows_how.image_id');
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    // Delete knowshow data in database
    function deleteKnowshowById($id){
        $this->db->where('id', $id);
        if($this->db->delete('knows_how')){
            return true;
        }
        return false;
    }
    
    // insert knowshow data in database
    public function addKnowshow($title,$description,$image_id){
        $knowshow['description'] = $description;
        $knowshow['title'] = $title;
        //$article['user_id'] = $user_id;
        $knowshow['image_id'] = $image_id;
        $knowshow['created_at'] = date("Y-m-d H:i:s");
        $knowshow['updated_at'] = date("Y-m-d H:i:s");
       // die(print_r($question));
        $res = $this->db->insert('knows_how', $knowshow);
        if($res){
            return $this->db->insert_id();
        }
        return 0;
    }
           
    // Get videos data in database
    function get_video() {
        $this->db->select('images.id as id, images.full_image_url as full_image_url, 
            videos.id as id, videos.title as title, videos.embeded_code as embeded_code,
            videos.description as description, videos.created_at as created_at');
        $this->db->from('videos');
        $this->db->join('images', 'images.id = videos.image_id');
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    // delete videos data in database
    function deleteVideoById($id){
        $this->db->where('id', $id);
        if($this->db->delete('videos')){
            return true;
        }
        return false;
    }
    
    // Insert videos data in database
    public function addVideo($title,$description,$image_id,$embeded_code){
        $video['description'] = $description;
        $video['title'] = $title;
        $video['embeded_code'] = $embeded_code;
        $video['image_id'] = $image_id;
        $video['created_at'] = date("Y-m-d H:i:s");
        $video['updated_at'] = date("Y-m-d H:i:s");
       // die(print_r($question));
        $res = $this->db->insert('videos', $video);
        if($res){
            return $this->db->insert_id();
        }
        return 0;
    }
    
    // get abuse data from database
    function get_reportabuse() {
        $this->db->select('answers.id as id, answers.description as description, answers.is_abuse as is_abuse, questions.id as questionsid, questions.title as title');
        $this->db->from('answers');
        $this->db->join('questions', 'questions.id = answers.question_id');
        $this->db->where('is_abuse', '1');
        $this->db->order_by('answers.updated_at', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    // delete abuse data in database
    function updateAbuseById($id){
        $this->db->set('is_abuse', '0');
        $this->db->where('id', $id);
        if($this->db->update('answers')){
            return true;
        }
        return false;
    }
    
    // delete abuse data in database
    function deleteAbuseById($id){
        $this->db->where('id', $id);
        if($this->db->delete('answers')){
            return true;
        }
        return false;
    }
    
    // get abuse data from database
    function get_booking() {
        $this->db->select('booking.id as id, name, booking.email as email, 
            booking.phone_no as phone_no, 
            booking.no_of_people as no_of_people, 
            booking.min_price as min_price, 
            booking.max_price as max_price, 
            booking.comments as comments, 
            booking.created_at as created_at,
            booking.trek as trek,
            booking.vendor as vendor
            ');
        $this->db->from('booking');
//        $this->db->join('vendor', 'booking.vendor_name = vendor.id');
//        $this->db->join('trek', 'booking.trek_name = trek.id');
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        //die(print_r($query));
        if ($query->num_rows() > 0) {
            //die(print_r($query->num_rows()));
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    // delete Booking data in database
    function deleteBookingById($id){
        $this->db->where('id', $id);
        if($this->db->delete('booking')){
            return true;
        }
        return false;
    }
    
    // Get trektalk data in database
    function get_trektalk() {
        $this->db->select('forum_type.id as type_id, forum_type.name as type_name, forum_topic.created_at as created_at,
            forum_topic.id as id, forum_topic.name as name, forum_topic.place as place, forum_topic.image_url as image_url');
        $this->db->from('forum_topic');
        $this->db->join('forum_type', 'forum_type.id = forum_topic.type_id');
//        $this->db->join('images', 'images.id = forum_topic.image_id');
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    // Get trektalk data in database
    function get_trektalk_type() {
        $this->db->select('id, name');
        $this->db->from('forum_type');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    // delete trektalk data in database
    function deleteTrektalkById($id){
        $this->db->where('id', $id);
        if($this->db->delete('forum_topic')){
            return true;
        }
        return false;
    }
    
    // Insert videos data in database
    public function addtrektalk($name,$place,$image_id,$type){
        $trektalk['name'] = $name;
        $trektalk['place'] = $place;
        $trektalk['type_id'] = $type;
        $trektalk['image_id'] = $image_id;
        $trektalk['created_at'] = date("Y-m-d H:i:s");
        $trektalk['updated_at'] = date("Y-m-d H:i:s");
        //die(print_r($trektalk));
        $res = $this->db->insert('forum_topic', $trektalk);
        if($res){
            return $this->db->insert_id();
        }
        return 0;
    }
}
?>