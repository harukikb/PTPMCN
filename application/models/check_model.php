<?php
class Check_model extends CI_Model
{
    public function check_booking($keyword){
        $this->db->where('booking_code',$keyword);
        $result = $this->db->get("booking_tour");
        //trả kết quả về dạng mảng
        return $result->result();
    }
}