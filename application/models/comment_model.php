<?php
/**
 * Description of common_model
 *
 * @author PR KATIYAR
 */
class Comment_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // Add enquiry
    public function addComment($enqid, $userid, $comment, $date) {

        $comments['userId'] = $userid;
        $comments['enqId'] = $enqid;
        $comments['comment'] = $comment;
        $comments['date'] = $date;
        // Query to insert data in database
        $this->db->insert('comments',$comments);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }    
    public function getcommentsByBookingId($enqid) {
        $this->db->select('comment, date, users.name');
        $this->db->from('comments');
        $this->db->join('users', 'users.id = comments.userId');
        $this->db->order_by('date',"DESC");
        $this->db->where("enqId", $enqid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }    
}
?>