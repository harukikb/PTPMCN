<?php
class home_model extends CI_Model
{
    public function getListTour()
    {

        $where="(tour_status=1 and tour_from='Quy Nhơn')";
        // $this->db->where(tour_status,1);
        // $this->db->where(tour_from,'Quy Nhơn');
        $this->db->where($where);
        $this->db->order_by("tour_hits","desc");
        $this->db->limit(6);

        //join cột điểm trung bình review của tour
        $sql_avg_star="(Select ROUND(AVG(rev_star),0) as avg_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as rev_tbl";
        $this->db->join($sql_avg_star,'rev_tbl.tour_id=tours.tour_id');

         //join cột tổng số lượng review của tour
         $sql_num_rev="(Select count(review_tour.tour_id) as num_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as revs_num";
         $this->db->join($sql_num_rev,'revs_num.tour_id=tours.tour_id');

        $query=$this->db->get("tours");
        //trả kết quả về dạng mảng
        return $query->result_array();
    }
}