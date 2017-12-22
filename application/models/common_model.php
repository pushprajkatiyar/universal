<?php

/**
 * Description of common_model
 *
 * @author PR KATIYAR
 */
class Common_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('My_PHPMailer');
    }
    
    // Get regions drop down
    public function getHomedata() {

        $this->db->select('id, quote_head, quote_content, image_url');
        $this->db->from('landing_image');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
    public function getAllDept() {

        $this->db->select('*');
        $this->db->from('empdepartment');
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result;
        } else {
            return array();
        }
    }
        
    // Get Vendor id by name
    public function getVendorIdByEmail($vendor_email) {

        $this->db->select('id, email');
        $this->db->from('vendor');
        $this->db->where("email", $vendor_email);
//        $this->db->where("lastname", $vendor_lname);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result =  $query->result();
            return $result[0]->id;
        } else {
            return "unknown";
        }
    }
    
    public function humanTiming ($time){
        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            //echo 'in'; die;
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }
    
    public function add_mail($send_to,$subject,$message){
        $mail['send_to'] = $send_to;
        $mail['subject'] = $subject;
        $mail['message'] = $message;
        $mail['created_at'] = date("Y-m-d H:i:s");
        
        $query = $this->db->insert('email', $mail);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    // Send Gmail to another user
    public function sendMail($receiver_email,$subject,$message) {
        $mail = new PHPMailer;

        $mail->IsSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtpauth.net4india.com';                         // Specify main and backup server
        $mail->Port = 25;                                      // Set the SMTP port
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = "enquiry@travios.in";                       // SMTP username
        $mail->Password =  "Travios@2017";                      // SMTP password
//        $mail->SMTPSecure = "tls";                              // Enable encryption, 'ssl' also accepted

        $mail->From = "enquiry@travios.in"; 
        $mail->FromName = "Enquiry";
//        $mail->AddAddress ("pushprajkatiyar@gmail.com");                    // Add a recipient
        $mail->AddAddress ($receiver_email);                    // Add a recipient

        $mail->IsHTML(true);                                    // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = "This is the body in plain text for non-HTML mail clients";
        if(!$mail->Send()) {
            echo "<script>alert ('Message could not be sent.)';</script>";
            echo "<script>alert ('Mailer Error: ' . $mail->ErrorInfo);</script>";
        exit;
        } else {
            return true;
            //echo "<script>alert('Message has been sent');</script>";
        }      
    }
    
    public function uploadAndResize($targetFile, $user_id = null, $is_gallery = 0){
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            //$config1['create_thumb'] = TRUE;
            $config['source_image'] = $targetFile;
            $config['maintain_ratio'] = true;
            $config['overwrite'] = true;
            $config['width']     = 800;
            $config['height']   = 800;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            //creating thumb 
            
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $targetFile;
            //$config1['create_thumb'] = TRUE;
            $config1['maintain_ratio'] = true;
            $config['overwrite'] = true;
            $config1['width']     = 400;
            $config1['height']   = 400;
            $config1['new_image'] = "x_thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config1);
            $this->image_lib->resize();
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $targetFile;
            //$config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = true;
            $config['overwrite'] = true;
            $config2['width']     = 270;
            $config2['height']   = 270;
            $config2['new_image'] = "thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            
            $data['full_image_url'] = ($user_id == NULL) ? "img/users/".$_FILES['file']['name'] : "img/users/$user_id/".$_FILES['file']['name'];
            $data['x_thumb_url'] = ($user_id == NULL) ? "img/users/".$config1['new_image'] : "img/users/$user_id/".$config1['new_image'];
            $data['thumb_url'] = ($user_id == NULL) ? "img/users/".$config2['new_image'] : "img/users/$user_id/".$config2['new_image'];
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['user_id'] = $user_id;
            $data['title'] = $_FILES['file']['name'];
            $data['is_gallery'] = $is_gallery;
//            die(print_r($data));
            $res = $this->db->insert('images', $data);
            if($res){
                return $this->db->insert_id();
            }
            return 0;
    }
    
    public function uploadAndResizeImage($targetFile, $user_id = null, $is_gallery = 0){
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            //$config1['create_thumb'] = TRUE;
            $config['source_image'] = $targetFile;
            $config['maintain_ratio'] = true;
            $config['overwrite'] = true;
            $config['width']     = 800;
            $config['height']   = 800;

            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();
            //creating thumb 
            
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $targetFile;
            //$config1['create_thumb'] = TRUE;
            $config1['maintain_ratio'] = true;
            $config['overwrite'] = true;
            $config1['width']     = 400;
            $config1['height']   = 400;
            $config1['new_image'] = "x_thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config1);
            $this->image_lib->resize();
            
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $targetFile;
            //$config2['create_thumb'] = TRUE;
            $config2['maintain_ratio'] = true;
            $config['overwrite'] = true;
            $config2['width']     = 270;
            $config2['height']   = 270;
            $config2['new_image'] = "thumb_".$_FILES['file']['name'];
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
            
            $data['full_image_url'] = ($user_id == NULL) ? "img/gallery/".$_FILES['file']['name'] : "img/gallery/".$_FILES['file']['name'];
            $data['x_thumb_url'] = ($user_id == NULL) ? "img/gallery/".$config1['new_image'] : "img/gallery/".$config1['new_image'];
            $data['thumb_url'] = ($user_id == NULL) ? "img/gallery/".$config2['new_image'] : "img/gallery/".$config2['new_image'];
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['user_id'] = $user_id;
            $data['title'] = $_FILES['file']['name'];
            $data['is_gallery'] = $is_gallery;
//            die(print_r($data));
            $res = $this->db->insert('images', $data);
            if($res){
                return $this->db->insert_id();
            }
            return 0;
    }
    
    // Insert review data in database
    public function trekBooking($name,$email,$phone,$start_date,$date_flexible,$people,$region,$vendor,$min_price,$max_price,$comment) {

        $booking['name'] = $name;
        $booking['email'] = $email;
        $booking['phone_no'] = $phone;
        $booking['start_date'] = $start_date;
        $booking['date_flexible'] = $date_flexible;
        $booking['no_of_people'] = $people;
        $booking['region'] = $region;
        $booking['vendor'] = $vendor;
        $booking['min_price'] = $min_price;
        $booking['max_price'] = $max_price;
        $booking['comments'] = $comment;
        $booking['created_at'] = date("Y-m-d H:i:s");
        $booking['updated_at'] = date("Y-m-d H:i:s");
        //die(print_r($booking));
        
        // Query to insert data in database
        $this->db->insert('booking',$booking);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Insert review data in database
    public function vendorBooking($name,$email,$phone,$start_date,$date_flexible,$people,$region,$trek,$min_price,$max_price,$comment) {
        //echo $start_date;
        
        $booking['name'] = $name;
        $booking['email'] = $email;
        $booking['phone_no'] = $phone;
        $booking['start_date'] = $start_date; //date("Y-m-d",strtotime($start_date));
        $booking['date_flexible'] = $date_flexible;
        $booking['no_of_people'] = $people;
        $booking['region'] = $region;
        $booking['trek'] = $trek;
        $booking['min_price'] = $min_price;
        $booking['max_price'] = $max_price;
        $booking['comments'] = $comment;
        $booking['created_at'] = date("Y-m-d H:i:s");
        $booking['updated_at'] = date("Y-m-d H:i:s");
        //die(print_r($booking));
        // Query to insert data in database
        $this->db->insert('booking',$booking);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function repeated_key_array_to_no_key_array($key, $array) {
        if(!is_array($array) || count($array) < 1) {
            return array();
        }
        $new_array = array();
        foreach($array as $row) {
            $new_array[] = $row[$key];
        }
        return $new_array;
    }
}
?>
