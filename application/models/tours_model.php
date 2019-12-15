<?php
class Tours_model extends CI_Model
{
    public function get_tour_info($tour_id){
        $result = $this->db->get_where("tours", array('tour_id' => $tour_id));
		return $result->row();
    }

    //search theo icon trên header
    public function getListHaveKey($keysearch,$page,$page_size){
        //join cột điểm trung bình review của tour
        $sql_avg_star="(Select ROUND(AVG(rev_star),0) as avg_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as rev_tbl";
        $this->db->join($sql_avg_star,'rev_tbl.tour_id=tours.tour_id');

        //join cột tổng số lượng review của tour
        $sql_num_rev="(Select count(review_tour.tour_id) as num_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as revs_num";
        $this->db->join($sql_num_rev,'revs_num.tour_id=tours.tour_id');

        //$query = $this->db->query("SELECT * FROM `tours` WHERE `tour_destination` like '%$keysearch%'");
        $this->db->or_where("`tour_destination` like '%$keysearch%' OR `tour_name` like '%$keysearch%' OR `tour_description` like '%$keysearch%'");
        $this->db->limit($page_size,($page-1)*$page_size);
        $query=$this->db->get("tours");
		return $query->result_array();
    }

    public function tours_count_key($keysearch){
        //join cột điểm trung bình review của tour
        $sql_avg_star="(Select ROUND(AVG(rev_star),0) as avg_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as rev_tbl";
        $this->db->join($sql_avg_star,'rev_tbl.tour_id=tours.tour_id');

        //join cột tổng số lượng review của tour
        $sql_num_rev="(Select count(review_tour.tour_id) as num_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as revs_num";
        $this->db->join($sql_num_rev,'revs_num.tour_id=tours.tour_id');

        //$query = $this->db->query("SELECT * FROM `tours` WHERE `tour_destination` like '%$keysearch%'");
        $this->db->or_where("`tour_destination` like '%$keysearch%' OR `tour_name` like '%$keysearch%' OR `tour_description` like '%$keysearch%'");
        $query=$this->db->get("tours");
		return count($query->result_array());
    }
    //tổng tour
    public function all_tour(){
        $query=$this->db->query("SELECT COUNT(`tour_id`) as `count` FROM `tours`");
        return $query->row();
    }

    public function get_tour_info_by_slug($tour_slug){
        
        //join cột điểm trung bình review của tour
        $sql_avg_star="(Select ROUND(AVG(rev_star),0) as avg_rev,tour_id from review_tour GROUP BY review_tour.tour_id union select tours.tour_price=0 as avg_rev,tour_id from tours where tour_id not in ( Select tour_id from review_tour GROUP BY review_tour.tour_id) and tours.tour_slug= '$tour_slug' ) as rev_tbl";
        $this->db->join($sql_avg_star,'rev_tbl.tour_id=tours.tour_id');

        //join cột điểm trung bình review quality của tour
        $sql_avg_star="(Select ROUND(AVG(rev_quality),0) as avg_quality,tour_id from review_tour GROUP BY review_tour.tour_id  union select tours.tour_price=0 as avg_quality,tour_id from tours where tour_id not in ( Select tour_id from review_tour GROUP BY review_tour.tour_id) and tours.tour_slug= '$tour_slug' ) as rev_tbl1";
        $this->db->join($sql_avg_star,'rev_tbl1.tour_id=tours.tour_id');
        
        //join cột điểm trung bình review price của tour
        $sql_avg_star="(Select ROUND(AVG(rev_price),0) as avg_price,tour_id from review_tour GROUP BY review_tour.tour_id  union select tours.tour_price=0 as avg_price,tour_id from tours where tour_id not in ( Select tour_id from review_tour GROUP BY review_tour.tour_id) and tours.tour_slug= '$tour_slug' ) as rev_tbl2";
        $this->db->join($sql_avg_star,'rev_tbl2.tour_id=tours.tour_id');
        
        //join cột điểm trung bình review guide của tour
        $sql_avg_star="(Select ROUND(AVG(rev_guide),0) as avg_guide,tour_id from review_tour GROUP BY review_tour.tour_id  union select tours.tour_price=0 as avg_guide,tour_id from tours where tour_id not in ( Select tour_id from review_tour GROUP BY review_tour.tour_id) and tours.tour_slug='$tour_slug' ) as rev_tbl3";
        $this->db->join($sql_avg_star,'rev_tbl3.tour_id=tours.tour_id');
        
        //join cột điểm trung bình review position của tour
        $sql_avg_star="(Select ROUND(AVG(rev_position),0) as avg_position,tour_id from review_tour GROUP BY review_tour.tour_id  union select tours.tour_price=0 as rev_position,tour_id from tours where tour_id not in ( Select tour_id from review_tour GROUP BY review_tour.tour_id) and tours.tour_slug= '$tour_slug' ) as rev_tbl4";
        $this->db->join($sql_avg_star,'rev_tbl4.tour_id=tours.tour_id');
        //join cột tổng số lượng review của tour
        $sql_num_rev="(Select count(review_tour.tour_id) as num_rev,tour_id from review_tour GROUP BY review_tour.tour_id  union select tours.tour_price=0 as num_rev,tour_id from tours where tour_id not in ( Select tour_id from review_tour GROUP BY review_tour.tour_id) and tours.tour_slug= '$tour_slug' ) as revs_num";
        $this->db->join($sql_num_rev,'revs_num.tour_id=tours.tour_id');
        $this->db->where('tour_slug',$tour_slug);
        $result = $this->db->get("tours");
		return $result->row();
    }
    
    public function getListReviewByID($tour_id){
        $this->db->where('tour_id',$tour_id);
        $result = $this->db->get("review_tour");
        //trả kết quả về dạng mảng
        return $result->result();
    }

    public function getListHaveFilter($category,$rating,$minprice,$maxprice,$orderby,$page,$page_size)
    {

        //lọc bài viết theo category 
        if($category!=NULL){
            $arr_category=explode(',', $category);
            foreach($arr_category as $item ){
                $this->db->or_where("$item in (SELECT `list_category_tour`.`category_tour_id` FROM `list_category_tour` WHERE `list_category_tour`.`tour_id`=tours.tour_id)");
            }
        }
        
        //join cột điểm trung bình review của tour
        $sql_avg_star="(Select ROUND(AVG(rev_star),0) as avg_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as rev_tbl";
        $this->db->join($sql_avg_star,'rev_tbl.tour_id=tours.tour_id');

        //lọc bài viết theo tiêu chí đánh giá
        if($rating!=NULL){
            $arr_rating=explode(',', $rating);
            foreach($arr_rating as $item ){
                $this->db->where('avg_rev=',$item);
            }
        }
        //lọc bài viết theo giá tour
        if($minprice!=NULL){
            $where="(tour_saving_price >=$minprice)";
            //$this->db->where('tour_saving_price >=',$minprice);
            //$this->db->or_where('tour_price >=',$minprice);
            $this->db->where($where);
        }
            
        if($maxprice!=NULL){
            $where="(tour_saving_price <=$maxprice)";
            //$this->db->where('tour_saving_price <=',$maxprice);
            //$this->db->or_where('tour_price <=',$maxprice);
            $this->db->where($where);
        }
        
        if($orderby!=NULL){
            switch ($orderby){
                case "pricelower":
                    $this->db->order_by("tour_saving_price", "asc"); 
                    break;
                case "pricehigher":
                    $this->db->order_by("tour_saving_price", "desc"); 
                    break;
            }
        }else{
            $this->db->order_by("tours.tour_id", "desc");
        }

        $this->db->limit($page_size,($page-1)*$page_size);
        //join cột tổng số lượng review của tour
        $sql_num_rev="(Select count(review_tour.tour_id) as num_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as revs_num";
        $this->db->join($sql_num_rev,'revs_num.tour_id=tours.tour_id');
        
        $query=$this->db->get("tours");
        
        //trả kết quả về dạng mảng
        return $query->result_array();
    }

    public function get_list_convenient_tour($tour_id){
        $this->db->join('convenient_tour','list_convenient_tour.conv_id=convenient_tour.conv_id');
        $this->db->where('tour_id',$tour_id);
        
        $query=$this->db->get("list_convenient_tour");
        //trả kết quả về dạng mảng
        return $query->result_array();
    }

    public function get_price_tour($tour_id){
        $this->db->where('tour_id',$tour_id);
        
        $query=$this->db->get("list_price_tour");
        //trả kết quả về dạng mảng
        return $query->row();
    }

    public function add_customer($name, $email, $phone, $address){
        $data=array(
            'cus_name'=>$name,
            'cus_email'=>$email,
            'cus_phone'=>$phone,
            'cus_address'=>$address
        );
        $this->db->query('ALTER TABLE `customer` AUTO_INCREMENT=1');
        //câu truy vấn insert
        $this->db->insert('customer', $data);
        $last_row = $this->db->order_by('cus_id',"desc")
            ->limit(1)
            ->get('customer')
            ->row();
        return $last_row->cus_id;
    }

    public function add_booking_tour($cus_id, $tour_id, $date_start, $num_adults, $num_childrens, $num_childs, $total_price, $booking_status, $booking_code){
        $data=array(
            'cus_id'=>$cus_id,
            'tour_id'=>$tour_id,
            'booking_start_date'=>$date_start,
            'booking_num_adult'=>$num_adults,
            'booking_num_children'=>$num_childrens,
            'booking_num_child'=>$num_childs,
            'booking_price'=>$total_price,
            'booking_status'=>$booking_status,
            'booking_code'=>$booking_code,
            "created_at" => date('Y-m-d H:i:s')
        );
        $this->db->query('ALTER TABLE `booking_tour` AUTO_INCREMENT=1');
        //câu truy vấn insert
        $this->db->insert('booking_tour', $data);
        $last_row = $this->db->order_by('booking_id',"desc")
            ->limit(1)
            ->get('booking_tour')
            ->row();
        return $last_row->booking_id;
    }

    public function get_booking_tour_info($booking_code){
        $this->db->where('booking_code',$booking_code);
        $this->db->join("customer",'customer.cus_id=booking_tour.cus_id');
        $this->db->join("tours",'tours.tour_id=booking_tour.tour_id');
        $result = $this->db->get("booking_tour");
        return $result->row();
    }

    public function tours_count($category,$rating,$minprice,$maxprice)
    {

        // //tìm kiếm theo button
        // if ($keysearch!=NULL){
        //     $this->db->or_where("`tour_destination` like '%$keysearch%'");
        // }
        //lọc bài viết theo category 
        if($category!=NULL){
            $arr_category=explode(',', $category);
            foreach($arr_category as $item ){
                $this->db->or_where("$item in (SELECT `list_category_tour`.`category_tour_id` FROM `list_category_tour` WHERE `list_category_tour`.`tour_id`=tours.tour_id)");
            }
        }
        
        //join cột điểm trung bình review của tour
        $sql_avg_star="(Select ROUND(AVG(rev_star),0) as avg_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as rev_tbl";
        $this->db->join($sql_avg_star,'rev_tbl.tour_id=tours.tour_id');
        //lọc bài viết theo tiêu chí đánh giá
        if($rating!=NULL){
            $this->db->where('avg_rev',$rating);
        }
        //lọc bài viết theo giá tour
        if($minprice!=NULL){
            $this->db->where('tour_saving_price >=',$minprice);
            //$this->db->or_where('tour_price >=',$minprice);
        }
            
        if($maxprice!=NULL){
            $this->db->where('tour_saving_price <=',$maxprice);
            //$this->db->or_where('tour_price <=',$maxprice);
        }
        //join cột tổng số lượng review của tour
        $sql_num_rev="(Select count(review_tour.tour_id) as num_rev,tour_id from review_tour GROUP BY review_tour.tour_id UNION SELECT tours.tour_price=0 as avg_rev,tour_id FROM tours where tours.tour_id not in (select tour_id from (Select tour_id from review_tour GROUP BY review_tour.tour_id) as temp)) as revs_num";
        $this->db->join($sql_num_rev,'revs_num.tour_id=tours.tour_id');
        $query=$this->db->get("tours");
        //đếm số lượng records
        return count($query->result_array());
    }

    public function getList($category,$rating,$minprice,$maxprice,$page,$page_size)
    {
        $query=$this->db->get("tours");
        //trả kết quả về dạng mảng
        return $query->result_array();
    }


    //update 11/4/2019
    public function getListCate()
    {
        
        $sql="(SELECT COUNT(`list_category_tour`.`category_tour_id`) as `num_cate`,`category_tour_id` FROM `list_category_tour` GROUP BY `list_category_tour`.`category_tour_id`) as `num_cate`";
        $this->db->join($sql,'category_tour.cate_id=num_cate.category_tour_id');
        $query=$this->db->get("category_tour");
        return $query->result_array();
    }

    //trả về true nếu có tồn tại
    public function check_tour_slug($tour_slug)
    {
        $this->db->select("tour_slug");
        $this->db->where("tour_slug", $tour_slug);
        $query=$this->db->get("tours");
        if($query->num_rows()>0){
            return true;
        }
        return false;
    }

    //trả về true nếu có tồn tại
    public function check_cate_slug($cate_slug,$cate_id=null)
    {
        if($cate_id==null){
            $this->db->select("cate_slug");
            $this->db->where("cate_slug", $cate_slug);
            $query=$this->db->get("category_tour");
            if($query->num_rows()>0){
                return true;
            }
        }
        else{
            $this->db->select("cate_slug");
            $this->db->where("cate_slug", $cate_slug);
            $this->db->where("cate_id !=", $cate_id);
            $query=$this->db->get("category_tour");
            if($query->num_rows()>0){
                return true;
            }
        }
        return false;
    }
}