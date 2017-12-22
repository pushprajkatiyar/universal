<?php
/**
 * Description of common_model
 *
 * @author PR KATIYAR
 */
class Enquiry_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('My_PHPMailer');
    }
    
    // Add enquiry
    public function addBooking($tourid,$name,$email,$phone,$touristCount,$start_date,$end_date,$price,$status, $comment) {

        $booking['name'] = $name;
        $booking['tourid'] = $tourid;
        $booking['addedByuserId'] = $this->session->userdata('id');
        $booking['email'] = $email;
        $booking['phone'] = $phone;
        $booking['touristCount'] = $touristCount;
        $booking['startDate'] = $start_date;
        $booking['endDate'] = $end_date;
        $booking['price'] = $price;
        $booking['status'] = $status;
        $booking['createdAt'] = date("Y-m-d H:i:s");
        $booking['updatedAt'] = date("Y-m-d H:i:s");
        
        // Query to insert data in database
        $this->db->insert('enquiry',$booking);
        if ($this->db->affected_rows() > 0) {
            $enqId = $this->db->insert_id();;
            $xrefenqdept['enqId'] = $enqId;
            $xrefenqdept['userId'] = $this->session->userdata('id');
            $xrefenqdept['date'] = "UTC_TIMESTAMP()";
            $xrefenqdept['deptId'] = 4;
            $this->db->insert('xrefenqdept',$xrefenqdept);
            return $enqId;
        } else {
            return 0;
        }
    }
    // Get enquiries list
    public function getBookingForEmp($dept = 1) {
        $this->db->select('enquiry.id, enquiry.name, enquiry.email, enquiry.phone, enquiry.touristCount, enquiry.price, '
                . 'tours.url as toururl, tours.name as tourname,tours.id as tourid, tours.profite as profite');
        $this->db->from('enquiry');
        $this->db->join('tours', 'enquiry.tourid = tours.id');
        $this->db->join('xrefenqdept', 'xrefenqdept.enqId = enquiry.id');
        $this->db->order_by('id',"DESC");
        $this->db->where("deptId", "$dept");
//        $this->db->where("lastname", $vendor_lname);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    // Get enquiries list
    public function getBookingForAgents($id) {
        $this->db->select('enquiry.id, enquiry.name, enquiry.email, enquiry.phone, enquiry.touristCount, enquiry.price, '
                . 'tours.url as toururl, tours.name as tourname,tours.id as tourid, tours.profite as profite');
        $this->db->from('enquiry');
        $this->db->join('tours', 'enquiry.tourid = tours.id');
        $this->db->order_by('id',"DESC");
        $this->db->where("addedByuserId", "$id");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    // Get enquiries list
    public function getBookingById($id) {
        $this->db->select('enquiry.id, enquiry.name, enquiry.email, enquiry.phone, enquiry.touristCount, enquiry.price, '
                . 'tours.url as toururl, tours.desc as description, tours.price as tourprice,tours.name as tourname,tours.id as tourid');
        $this->db->from('enquiry');
        $this->db->join('tours', 'enquiry.tourid = tours.id');
        $this->db->where("enquiry.id", $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return array();
        }
    }
     // Get enquiries count
    public function getBookingCounts($today = false) {
        if($today){
            $between = "createdAt BETWEEN '".date("Y-m-d")." 00:00:00' AND '".date("Y-m-d")." 23:59:59' ";
        }else{
            $between = "createdAt BETWEEN '1970-01-01' AND '".date("Y-m-d")." 23:59:59'";
        }
        $this->db->select('count(*) as total');
        $this->db->from('enquiry');
        $this->db->where($between);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result[0]->total;
        } else {
            return 0;
        }
    }
     // Get last 15 days graph data
    public function getGraphData($limit = 15) {
        $this->db->select('Count(*) as sum, DATE(createdAt) as day');
        $this->db->from('enquiry');
        $this->db->group_by("DATE(createdAt)");
        $this->db->limit($limit);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result('array');
        } else {
            return array();
        }
    }
    
    public function updateDept($enqid, $toDept, $userid){
        $this->db->where('enqId', $enqid);
        
        $res = $this->db->delete('xrefenqdept');
        $booking['userId'] = $userid;
        $booking['enqId'] = $enqid;
        $booking['deptId'] = $toDept;
        $booking['date'] = date("Y-m-s H:i:s");
        $res = $this->db->insert('xrefenqdept', $booking); 
        return $res;
    }
    public function closeBooking($enqid){
        $enquiry['completed'] = 1;
        $this->db->where('Id', $enqid);
        $res = $this->db->update('enquiry', $enquiry);
        
        return $res;
    }
}
?>