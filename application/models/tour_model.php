<?php
/**
 * Description of common_model
 *
 * @author PR KATIYAR
 */
class Tour_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
       
    public function getTours() {
        $this->db->select('*');
        $this->db->from('tours');
        $this->db->order_by('Name',"ASC");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getTourById($id) {
        $this->db->select('*');
        $this->db->from('tours');
        $this->db->where('id',$id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return array();
        }
    }    
}
?>