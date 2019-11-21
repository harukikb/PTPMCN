<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends CI_Controller {
    var $data = array();
    var $page_size=1;
    public function __construct(){
        parent::__construct();  
        $this->load->library("cart");
    } 

    /*
    //
    //Khu vực load view
    //
    */
	public function index()
	{
        $this -> data['title'] = "Booking Tour";
        //Set style display of list tour
        //1: list tour
        //2: grid tour
        $view_style=1;
        $view=$this->input->get('view');
        if($view !==NULL){
            $view_style=$this->input->get('view');
        }
        if($view_style==1)
            $this -> data['temp'] = "default/tour/tour";
        else{
            $this -> data['temp'] = "default/tour/tour-grid";
        }


        $this -> data['after_header'] = "default/tour/slide"; 

        //import javascript internal
        $this -> data['custom_js'] = array(
            "assets/default/js/cat_nav_mobile.js",
            "assets/default/js/map.js",
            "assets/default/js/infobox.js",
            "assets/default/js/lazysizes.min.js",
            "assets/default/js/tour.js");
        //import javascript external
        $this -> data['custom_js_external'] = array(
            "https://maps.googleapis.com/maps/api/js");

        //get catelogy tour
        $this->load->model("tours_model");
        $cate_tour=$this->tours_model->getListCate();
        $this->data['cate_tour']=$cate_tour;
        
        //tổng số lượng tour
        $all_tour=$this->tours_model->all_tour();
        $this->data['all_tour']=$all_tour;


        // $key=$this->input->get('q');
        // $this->data['keysearch']=$key;
        // $data_tour=$this->tours_model->search_icon($key);
        // $this->data['data_tour']=$data_tour;

        //load master page
        $this->load->view("default/template",$this ->data);

        
        
    }


    //controller icon search header
    public function get_list_tour_key(){
        $this->load->model("tours_model");
        $key=$this->input->get('keysearch',true);
        $page=$this->input->get('page',true);
        if($page==NULL) $page=1;
        //$key="Nẵng";
        $arr=$this->tours_model->getListHaveKey($key,$page,$this->page_size);
        //echo $this->db->last_query();
        //đếm số lượng ds bài post lấy đc
        $arr['total_record']=count($arr);
        $arr['tours_count']=$this->tours_model->tours_count_key($key);
        $arr['page_size']=$this->page_size;
        $arr['current_page']=$this->input->get('page',true);
        
        echo json_encode($arr);
        
    }

    //Single tour page
    public function detail()
    {
        $this->load->model("tours_model");
        $this -> data['title'] = "Booking Tour";
        $this -> data['after_header'] = "default/tour/tour-detail-slide"; 

        $this -> data['temp'] = "default/tour/tour-detail";

        $this -> data['after_footer'] = "default/tour/after-footer-tour-detail";

        $this -> data['custom_js'] = array(
            "assets/default/js/jquery.sliderPro.min.js",
            "assets/default/assets/validate.js",
            "assets/default/js/map.js",
            "assets/default/js/infobox.js",
            "assets/default/js/theia-sticky-sidebar.js",
            "assets/default/js/tour-detail.js");

        $this -> data['custom_js_external'] = array(
            "https://maps.googleapis.com/maps/api/js");
        
        //get slug tour
        $tour_slug=$this->uri->segment(3);
        $info_tour=$this->tours_model->get_tour_info_by_slug($tour_slug);
        if($info_tour==NULL)
            redirect(base_url().'tour');
        else{
            $this ->data['info_tour']=$info_tour;
            //get list review of tour by tour id
            $this ->data['list_convenient']=$this->tours_model->get_list_convenient_tour($info_tour->tour_id);
            $this ->data['reviews_tour']=$this->tours_model->getListReviewByID($info_tour->tour_id);
            $this ->data['prices_tour']=$this->tours_model->get_price_tour($info_tour->tour_id);
            $this->load->view("default/template",$this ->data);
        }
            
    }

    //Function cart for booking tour
    public function cart(){
        $this -> data['title'] = "Place Your Order";
        $this -> data['after_header'] = "default/tour/tour-cart-slide"; 

        $this -> data['temp'] = "default/tour/cart";


        $this->load->view("default/template",$this ->data);
    }

    //Function checkout for booking tour
    public function payment(){
        $this -> data['title'] = "Place Your Order";
        $this -> data['after_header'] = "default/tour/tour-payment-slide"; 

        $this -> data['temp'] = "default/tour/payment";

        $this -> data['custom_js'] = array(
            "assets/default/js/theia-sticky-sidebar.js",
            "assets/default/js/tour-detail.js");

        $this->load->view("default/template",$this ->data);
    }

    //Function confirmation for booking tour
    public function confirmation(){
        $this -> data['title'] = "Confirmation";
        $this -> data['after_header'] = "default/tour/tour-confirm-slide"; 

        $this -> data['temp'] = "default/tour/confirm";

        $this->load->view("default/template",$this ->data);
    }

    /*
    //
    //Khu vực cho method ajax
    //
    */

    public function get_list_tour(){
        $this->load->model("tours_model");

        

        $category=$this->input->get('category');
        $rating=$this->input->get('rating');
        $minprice=((int)$this->input->get('minprice'))*1000;
        $maxprice=((int)$this->input->get('maxprice'))*1000;
        $page=$this->input->get('page');
        $orderby=$this->input->get('orderby');
        if($page==NULL) $page=1;
        
        //lấy ds bài post
        $arr=$this->tours_model->getListHaveFilter($category,$rating,$minprice,$maxprice,$orderby,$page,$this->page_size);
        //echo $this->db->last_query();
        //đếm số lượng ds bài post lấy đc
        $arr['total_record']=count($arr);
        $arr['tours_count']=$this->tours_model->tours_count($category,$rating,$minprice,$maxprice);
        $arr['page_size']=$this->page_size;
        
        echo json_encode($arr);
    }

    
    public function submit_review_tour(){
        $result = array();
        $this->load->model("tours_model");

        $tour_id  = $this->input->post('tour_id',TRUE);
        $name_review  = $this->input->post('name_review',TRUE);
        $date_get_tour  = $this->input->post('date_get_tour',TRUE);
        $email_review  = $this->input->post('email_review',TRUE);
        $position_review = $this->input->post('position_review',TRUE);
        $guide_review = $this->input->post('guide_review',TRUE);
        $price_review = $this->input->post('price_review',TRUE);
        $quality_review =$this->input->post('quality_review',TRUE);
        $review_text = $this->input->post('review_text',TRUE);
        //$verify_review  = $this->input->post('verify_review',TRUE);
        
        if(trim($name_review) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Bạn phải nhập tên của bạn.</div>';
        }else if(trim($email_review) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Vui lòng nhập một địa chỉ email hợp lệ.</div>';
            
        } else if(!$this->isEmail($email_review)) {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Địa chỉ email bạn vừa nhập không hợp lệ, vui lòng nhập lại.</div>';
        }else if(trim($position_review ) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Vui lòng đánh giá vị trí.</div>';
            
        } else if(trim($guide_review ) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Vui lòng đánh giá hướng dẫn viên du lịch.</div>';
            
        } else if(trim($price_review ) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Vui lòng đánh giá giá tour.</div>';
            
        } else if(trim($quality_review ) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Vui lòng đánh giá chất lượng.</div>';
            
        } else if(trim($review_text) == '') {
            $result['status'] = 0;
            $result['message'] = '<div class="error_message">Vui lòng nhập đánh giá của bạn.</div>';
            
        } //else if(!isset($verify_review) || trim($verify_review) == '') {
        //     $result['status'] = 0;
        //     $result['message'] = '<div class="error_message"> Vui lòng nhập số xác minh.</div>';
            
        // }
        //  else if(trim($verify_review) != '4') {
        //     echo '<div class="error_message">The verification number you entered is incorrect.</div>';
        //     exit();
        // }
        else{
            
            if(!$this->tours_model->add_review_tour(trim($tour_id),
                                                    trim($name_review),
                                                    $date_get_tour,
                                                    trim($email_review),
                                                    (int)trim($position_review),
                                                    (int)trim($guide_review),
                                                    (int)trim($price_review),
                                                    (int)trim($quality_review),
                                                    trim($review_text)))
            {
                $result['status'] = 0;
                $result['message']='<div class="error_message"><span class="icon_dislike" aria-hidden="true"></span> Có lỗi xảy ra, vui lòng thử lại sau!.</div>';
            }else{
                $result['status'] = 1;
                $result['message']="<div id='success_page' style='padding:20px 0'>";
                $result['message'].="Cảm ơn <strong>$name_review</strong>,<br> bản đánh giá của bạn đã được gửi thành công!";
                $result['message'].="</div>";
            }
            
        }

        echo json_encode($result);
    }

    public function submit_booking_tour(){
        $this->load->library("cart");
        $result = array();

        $tour_id  = $this->input->post('tour_id',TRUE);
        $tour_name = $this->input->post('tour_name',TRUE);
        $date_start  = $this->input->post('date_start',TRUE);
        $time_start = $this->input->post('time_start',TRUE);
        $num_adults = $this->input->post('num_adults',TRUE);
        $num_childrens = $this->input->post('num_childrens',TRUE);
        $num_childs = $this->input->post('num_childs',TRUE);
        $price_adult=$this->input->post('price_adult',TRUE);
        $price_children=$this->input->post('price_children',TRUE);
        $price_child=$this->input->post('price_child',TRUE);
        $data=array(
            'id'      => $tour_id,
            'qty'     => 1,
            'price'   => $num_adults*$price_adult+$num_childrens*$price_children+$num_childs*$price_child,
            'name'    => $tour_name,
            'options' => array(
                'tour_id' => $tour_id,
                "date_start" => $date_start,
                "time_start" => $time_start,
                "num_adults" => $num_adults,
                "num_childrens" => $num_childrens,
                "num_childs" => $num_childs,
                "price_adult" => $price_adult,
                "price_children" => $price_children,
                "price_child" => $price_child
            )
        );
        
        if($num_adults==0&&$num_childrens==0&&$num_childs==0){
            $result['status'] = 0;
            $result['message']="Vui lòng chọn số lượng người đi tour phù hợp!";
            
        }
        else{
            // Them san pham vao gio hang
            if($this->cart->insert($data)){
                $result['status'] = 1;
                $result['message']="Success";
            }else{
                $result['status'] = 0;
                $result['message']="Có lỗi xảy ra, vui lòng thử lại sau!";
            }
        }
        
        
        

        echo json_encode($result);
    }

   
    /*
    //
    //Khu vực cho method custom
    //
    */
    function isEmail($email_review ) {
        return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email_review ));
    }
    
}
