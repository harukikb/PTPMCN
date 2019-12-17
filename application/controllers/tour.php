<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tour extends CI_Controller {
    var $data = array();
    var $page_size=3;
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
        
        $this -> data['temp'] = "default/tour/tour";


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

    //Function checkout for booking tour
    public function payment(){
        $this->load->model("tours_model");
        $this -> data['title'] = "Place Your Order";
        $this -> data['after_header'] = "default/tour/tour-payment-slide"; 

        $this -> data['temp'] = "default/tour/payment";

        $this -> data['custom_js'] = array(
            "assets/default/js/theia-sticky-sidebar.js",
            "assets/default/js/payment.js");
        $num_adults=$this->input->get('num_adults')!=NULL?$this->input->get('num_adults'):0;
        $this->data['num_adults']=$num_adults;
        $num_childrens=$this->input->get('num_childrens')!=NULL?$this->input->get('num_childrens'):0;
        $this->data['num_childrens']=$num_childrens;
        $num_childs=$this->input->get('num_childrens')!=NULL?$this->input->get('num_childs'):0;
        $this->data['num_childs']=$num_childs;
        $this->data['tour_id']=$this->input->get('tour_id')!=NULL?$this->input->get('tour_id'):0;

        $this->data['tour_name']=$this->input->get('tour_name')!=NULL?$this->input->get('tour_name'):0;
        $this->data['date_start']=$this->input->get('date_start')!=NULL?$this->input->get('date_start'):0;
        $price_tour=$this->tours_model->get_price_tour($this->input->get('tour_id'));
        $this ->data['prices_tour']=$price_tour;
        $total_price=($price_tour->price_adult)*(int)$num_adults+($price_tour->price_children)*(int)$num_childrens+($price_tour->price_child)*(int)$num_childs;
        $this->data['total_price']=$total_price;
        $this->load->view("default/template",$this ->data);
    }

    //Function confirmation for booking tour
    public function confirmation(){
        $this->load->model("tours_model");
        $this -> data['title'] = "Confirmation";
        $this -> data['after_header'] = "default/tour/tour-confirm-slide"; 

        $this -> data['temp'] = "default/tour/confirm";
        $booking_code=$this->input->get('bookingnumber');
        $this->data['booking_info']=$this->tours_model->get_booking_tour_info($booking_code);

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

   public function submit_checkout_tour(){
        $result = array();
        $this->load->model("tours_model");

        $name  = $this->input->post('name',TRUE);
        $email  = $this->input->post('email',TRUE);
        $phone  = $this->input->post('phone',TRUE);
        $address  = $this->input->post('address',TRUE);
        $tour_id  = $this->input->post('tour_id',TRUE);
        $tour_name  = $this->input->post('tour_name',TRUE);
        $date_start  = $this->input->post('date_start',TRUE);
        $num_adults = $this->input->post('num_adult',TRUE);
        $num_childrens = $this->input->post('num_children',TRUE);
        $num_childs = $this->input->post('num_child',TRUE);
        $cus_id=$this->tours_model->add_customer(trim($name),trim($email),trim($phone),trim($address));

        if($cus_id==NULL)
        {
            $result['status'] = 0;
            $result['message']='<div class="error_message"><span class="icon_dislike" aria-hidden="true"></span> Có lỗi xảy ra, vui lòng thử lại sau!.</div>';
        }else{
            $tour_price=$this->tours_model->get_price_tour($tour_id);
            $total_price=($tour_price->price_adult)*(int)$num_adults+($tour_price->price_children)*(int)$num_childrens+($tour_price->price_child)*(int)$num_childs;
            $booking_code= $this->random_number();
            $booking_status=1;
            $booking_id=$this->tours_model->add_booking_tour(trim($cus_id),
                                                    trim($tour_id),
                                                    $date_start,
                                                    (int)trim($num_adults),
                                                    (int)trim($num_childrens),
                                                    (int)trim($num_childs),
                                                    (int)trim($total_price),
                                                    (int)trim($booking_status),
                                                    trim($booking_code));
            if($booking_id==NULL)
            {
                $result['status'] = 0;
                $result['message']='<div class="error_message"><span class="icon_dislike" aria-hidden="true"></span> Có lỗi xảy ra, vui lòng thử lại sau!.</div>';
            }else{
                if($email !=null ) {
                    if ($this->send_mail($email, $booking_code,$name, $phone)) {
                        $result['status'] = 1;
                    } else $result['status'] = 0;
                }
                
                //$result['status'] = 1;
                $result['id']=$booking_code;
            }
        }

        echo json_encode($result);
    }

    private function send_mail($to_email, $booking_code, $name, $phone) {
        $this->load->library('email');
        $config = array();
        $localhosts = array(
            '::1',
            '127.0.0.1',
            'localhost'
        );
        
        $protocol = 'mail';
        if (in_array($_SERVER['REMOTE_ADDR'], $localhosts)) {
            $protocol = 'smtp';
        }
        $config['protocol'] = $protocol;
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_user'] = 'truonglongsometimes2297@gmail.com';
        $config['smtp_pass'] = 'wqbhsrpipqzpuxeb';
        $config['smtp_port'] = 465;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $from_email = "truonglongsometimes2297@gmail.com";
        //Load email library
        
        $this->email->from($from_email, 'Booking Tour Successfull');
        $this->email->to($to_email);
        $this->email->subject('Send Email Code Booking Tour');
        $this->email->message('The email send from Booking System
                                <h3>Thank you to booking tour from our Booking System</h3>
                                <p>Your Booking Code: <strong>'.$booking_code.'</strong></p>
                                <p>Your Name: '.$name.'</p>
                                <p>Your Phone: '.$phone.'</p>
                                <p>You can use it to check details of tour orders in <a href="http://localhost:8080/Bookingtour/check" target="_blank">Check</a>. </p>');
        //Send mail
        if($this->email->send())
            return true;
        else
            return false;
    }

    public function random_number($maxlength = 10) {
        $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                        "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $return_str = "";
        $timeStamp = date('YmdHis');
        for ( $x=0; $x<=$maxlength; $x++ ) {
            $return_str .= $chary[rand(0, count($chary)-1)];
        }
        $code=$return_str.$timeStamp;
        return $code;
    } 
    
    
}
