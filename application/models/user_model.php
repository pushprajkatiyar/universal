<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function login($email,$password) { 
        $sql = "SELECT users.id, users.email, users.userTypeId, users.plant_id, users.name FROM users WHERE BINARY email='$email' AND BINARY password='$password'";
        $query=$this->db->query($sql);
        if($query->num_rows()>0) {
            return $query->result();
            return true;
        }
        return false;
    }
    
    // Insert registration data in database
    public function registration_insert($post_data) {

        // Query to check whether username already exist or not
        $condition = "email =" . "'" . $post_data['email'] . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {

            // Query to insert data in database
            $this->db->insert('users', $post_data);
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        } else {
            return false;
        }
    }
           
    // Read data from database to show data in admin page
    public function getuserById($user_id) {
        $condition = "id ='$user_id'";
        $this->db->select('*');
        $this->db->from('users');
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
    public function getLastuserById() {

        //$condition = "id =" . "'" . id . "'";
        $this->db->select('id, name, dob, description, email, phone_no, last_visit, status, kms_clocked, title, trekpoints,endorsement, profile_image_id');
        $this->db->from('users');
        //$this->db->where($condition);
        $this->db->limit(1);
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result =  $query->result();
            return $result[0];
        } else {
            return array();
        }
    }
    
    // Read data from database to show data in admin page
    public function getuserByEmail($email) {

        $condition = "email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return array();
        }
    }
    // Get all articals postedby user in blog section
    public function getUserArticalsById($user_id) {

        $condition = "user_id ='$user_id'";
        $this->db->select('*');
        $this->db->from('blog_post');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return array();
        }
    }
    // Get all given answers by user
    public function getUserAnswersById($user_id) {

        $condition = "user_id ='$user_id'";
        $this->db->select('*');
        $this->db->from('answers');
        $this->db->where($condition);
        //$this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function updateUser($userdata, $userid){
        //$condition = "user_id ='$userid'";
        $this->db->where('id', $userid);
        $res = $this->db->update('users', $userdata); 
        return $res;
    }
    
    public function insertActivities($user_activities, $userid){
        $del = $this->db->delete('adventure_activites_userdata', array('user_id' => $userid));
        if($del){
            foreach($user_activities as $user_activity) {
                $data = array(
                    'adventure_activity_id' => $user_activity,
                    'user_id' => $userid,
                    'created_at' => date("Y-m-d H:i:s")
                    );
            
                $res=$this->db->insert('adventure_activites_userdata', $data);
            }
        }
        if($res){
            return $res;
        }
        return 0;
    }
    
    public function updateQuote($userdata, $userid){
        //$condition = "user_id ='$userid'";
        $this->db->where('id', $userid);
        $res = $this->db->update('users', $userdata); 
        return $res;
    }
    
    public function updateCookie($userid, $random_string){
        $this->db->where('id', $userid);
        $userdata['remember_me_token'] = $random_string;
        $res = $this->db->update('users', $userdata); 
        return $res; 
    }
    
    public function getCookieValue($cookie){
        if($cookie == ''){
            return array();
        }
        $condition = "remember_me_token ='$cookie'"; 
        $this->db->select('id,name,email,profile_image_id');
        $this->db->from('users');
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res[0];
        } else {
            return array();
        }
    }
    
    function updateProfileEndores($user_id){
        $sql = "UPDATE users SET endorsement = endorsement + 1 WHERE id = $user_id";
        if($this->db->query($sql)){
            return true;
        }
        return false;
    }
}

?>