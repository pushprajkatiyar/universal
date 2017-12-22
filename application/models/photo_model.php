<?php
/**
 * Description of photo_model
 *
 * @author PR KATIYAR
 */
class Photo_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * function for getting pictures by user id 
     * argument user_id
     * return type array
     */
    function imagesByUserId($user_id){
         //checking for empty user_id
        if(empty($user_id)){
            die('userid contain no data');
      
            }
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where("user_id",$user_id);
        $this->db->where('is_gallery',1);
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();
        if($query->num_rows()>0) {
            $results = $query->result();
            
            return $results;
        }
        return array();
    }
    
    /*
     * function for getting image by it's id 
     * argument user_id
     * return type array
     */
    function imageByImageId($image_id){
         //checking for empty image_id
        if(empty($image_id)){
            die('image id contain no data');
        }
        $this->db->select('images.id, images.likes, user_id, trek_id, thumb_url, x_thumb_url, vendor_id, full_image_url, images.title, images.created_at, users.name');
        $this->db->from('images');
        $this->db->join('users', 'images.user_id = users.id');
        $this->db->where("images.id",$image_id);
        
        $query = $this->db->get();
        if($query->num_rows()>0) {
            $result = $query->result();
            return $result[0];
        }
        return array();
    }
    
    function getProfileImageByImageId($image_id){
        //die(print_r($image_id));
//        if(empty($image_id)){
//            die('image id contain no data');
//        }
        $this->db->select('images.id as id, images.thumb_url as thumb_url, images.x_thumb_url as x_thumb_url');
        $this->db->from('images');
//        $this->db->join('images', 'users.profile_image_id = images.id');
        $this->db->where("images.id",$image_id);
        //$this->db->limit(1);

        $query = $this->db->get();
        if($query->num_rows()>0) {
            $result = $query->result();
            return $result[0];
        }
        return array();
    }
    
    /*
     * function for getting image by it's id 
     * argument user_id
     * return type array
     */
    
    function getGalleryImages(){
        $this->db->select('images.id,images.likes, user_id, trek_id, thumb_url, x_thumb_url, vendor_id, full_image_url, images.title, images.created_at, users.name');
        $this->db->from('images');
        $this->db->join('users', 'images.user_id = users.id');
        $this->db->where('is_gallery',1);
        $this->db->limit(20);
        $this->db->order_by("likes", "desc");
        $query = $this->db->get();
        
        if($query->num_rows()>0) {
            $result = $query->result();
            return $result;
        }
        return array();
    }
     /*
     * function for getting image by free search
     * argument keyword
     * return type array
     */
    
    function getFreeSearchImages($keyword){
        $this->db->select('images.id, images.likes, user_id, trek_id, thumb_url, x_thumb_url, vendor_id, full_image_url, images.title, images.created_at, users.name');
        $this->db->from('images');
        $this->db->join('users', 'images.user_id = users.id');
        $this->db->where("images.title LIKE '%$keyword%'"); 
        $this->db->limit(20);
        $this->db->order_by("likes", "desc");
        $query = $this->db->get();
        
        if($query->num_rows()>0) {
            $result = $query->result();
            return $result;
        }
        return array();
    }
    
    function updateImageLikes($image_id){
        $sql = "UPDATE images SET likes = likes + 1 WHERE id = $image_id";
        if($this->db->query($sql)){
            return true;
        }
        return false;
    }
    
    // delete Articles data in database
    function deleteImageById($id){
        $this->db->where('id', $id);
        if($this->db->delete('images')){
            return true;
        }
        return false;
    }
    
    function getGalleryImagesById($image_id){
        $this->db->select('*');
        $this->db->from('images');
        $this->db->where('id',$image_id);
        $query = $this->db->get();
        
        if($query->num_rows()== 1) {
            $result = $query->result();
            return $result[0];
        }
        return array();
    }
}

?>