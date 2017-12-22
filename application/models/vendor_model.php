<?php
/**
 * Description of vendor_model
 *
 * @author PR KATIYAR
 */
class Vendor_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
// returns all vendor data from vendor table
    public function getVendorById($user_id) {

        $condition = "id =" . "'" . $user_id . "'";
        $this->db->select('vendor.id as id, vendor.firstname as firstname, vendor.lastname as lastname,
            vendor.email as email, vendor.phone as phone, vendor.website as website, vendor.description as description,
            vendor.updated_at as updated_at, vendor.created_at as created_at,
            (SELECT AVG(rating) FROM vendor_review where vendor_id = vendor.id) as rating');
        //$this->db->select('id, firstname, lastname, email, phone, website, rating, description, updated_at');
        $this->db->from('vendor');
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
    
    // returns all vendor offered treks
    public function getOfferedTreksByVendorId($vendor_id) {

        $condition = "vendor_id ='$vendor_id'";
        
        $this->db->select('trek.id as id, trek.title as title, 
            trek.rating as rating, 
            offered_trek.cost as cost,
            offered_trek.description as description,
            offered_trek.start_date as startdate,
            offered_trek.end_date as enddate,
            (select count(*) from trek_review where trek_id = trek.id)  as total_reviews');
        $this->db->from('offered_trek');
        $this->db->join('trek', 'trek.id = offered_trek.trek_id');
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    
    // returns all vendor page slider images from vendor_image_slider table
    public function getVendorSliderByVendorId($vendor_id) {

        $condition = "vendor_id = '$vendor_id '";
        $this->db->select('image_url');
        $this->db->from('vendor_image_slider');
        $this->db->where($condition);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }

    // returns all vendor reviews from vendor_reviews table
    public function getVendorReviewsByVendorId($vendor_id) {

        $condition = "vendor_id = '$vendor_id '";
        $this->db->select('users.name as name, users.id as userid, users.rating as user_rating, vendor_review.id as id, 
            vendor_review.title as title, vendor_review.description as description, 
            vendor_review.rating as rating, vendor_review.created_at as created_at');
        $this->db->from('vendor_review');
        $this->db->join('users', 'vendor_review.user_id = users.id');
        $this->db->where($condition);
        $this->db->order_by('created_at', 'DESC');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function review_insert($title,$rating,$description,$user_id,$vendor_id) {

        $vendor_review['title'] = $title;
        $vendor_review['description'] = $description;
        $vendor_review['vendor_id'] = $vendor_id;
        $vendor_review['user_id'] = $user_id;
        $vendor_review['rating']=$rating;
        $vendor_review['created_at'] = date("Y-m-d H:i:s");
        
//        $vendor['rating']=$rating;
//        $vendor['updated_at'] = date("Y-m-d H:i:s");

        // Query to insert data in database
        $ress = $this->db->insert('vendor_review', $vendor_review);
        if ($ress > 0) {
//            $res = $this->db->update('vendor', $vendor, array('id' => $vendor_id));
//            if ($res > 0){
//                return true;
//            }  else {
//                return false;
//            }
            return true;
        } else {
            return false;
        }
    }

}

?>
