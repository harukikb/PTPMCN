<?php
class Check_model extends CI_Model
{
    public function check_booking($keyword){
        $this->db->where('booking_code',$keyword);
        $this->db->join("customer",'customer.cus_id=booking_tour.cus_id');
        $this->db->join("tours",'tours.tour_id=booking_tour.tour_id');
        $result = $this->db->get("booking_tour");
        //trả kết quả về dạng mảng
        return $result->result();
    }

    
}