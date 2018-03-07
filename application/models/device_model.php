<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Device_model extends CI_Model {

    public function __construct() {
        parent::__construct();
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
    public function getDevicesByPlantId($plant_id) {
        $condition = "plant_id ='$plant_id'";
        $this->db->select('*');
        $this->db->from('device');
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    // Get device recent history
    public function getRecentHistoryByDeviceId($device_id,  $columns,  $limit = 30) {
        $condition = "device_id ='$device_id'";
        $this->db->select("$columns");
        $this->db->from('device_history');
        $this->db->where($condition);
        $this->db->order_by("history_id", "DESC");
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function getDeviceHistory($device_id, $clms, $whr){
        $condition = "device_id = $device_id ";
        $this->db->select($clms);
        $this->db->from('device_history');
        $this->db->where($condition);
        $this->db->where($whr);
        $this->db->order_by("history_id", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    public function getSmsAlert($device_id, $limit = 100){
        $this->db->select("send_to, msg, send_at");
        $this->db->from('sms_alert');
        $this->db->limit($limit);
        $this->db->where("device_id", $device_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    public function getEmailAlert($device_id, $limit = 100){
        $this->db->select("send_to, msg, send_at");
        $this->db->from('email_alerts');
        $this->db->limit($limit);
        $this->db->where("device_id", $device_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
}

?>