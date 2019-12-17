<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check extends CI_Controller {
    var $data = array();
    public function __construct(){
        parent::__construct();  
        
    } 

	public function index()
	{
        $this -> data['title'] = "Tra đơn đặt tour";  
        
        $this -> data['temp'] = "default/check_booking/check";
        
        $this -> data['after_header'] = "default/check_booking/header_check"; 

        //import javascript internal
        $this -> data['custom_js'] = array(
            "assets/default/js/cat_nav_mobile.js",
            "assets/default/js/map.js",
            "assets/default/js/infobox.js",
            "assets/default/js/lazysizes.min.js");
            
        //import javascript external
        $this -> data['custom_js_external'] = array(
            "https://maps.googleapis.com/maps/api/js");
        
            $this -> data['custom_js'] = array(
                "assets/default/js/jquery.sliderPro.min.js",
                "assets/default/assets/validate.js",
                "assets/default/js/map.js",
                "assets/default/js/infobox.js",
                "assets/default/js/theia-sticky-sidebar.js",
                "assets/default/js/check.js");
    
            $this -> data['custom_js_external'] = array(
                "https://maps.googleapis.com/maps/api/js");
            

        //load master page
        $this->load->view("default/template",$this ->data);
    }

    public function check_booking(){
        $this->load->model("check_model");
        $keyword=$this->input->post('keyword',true);
<<<<<<< HEAD
        $arr['result']=$this->check_model->check_booking($keyword);
        $arr['total_record']=count($arr['result']);
=======
        $arr=$this->check_model->check_booking($keyword);
        $arr['total_record']=count($arr);

        // $number_per=$this->check_model->number_adult($keyword);
        // $number_adult=$number_per->booking_num_adult;
        // $number_children=$number_per->booking_num_children;
        // $number_child=$number_per->booking_num_child;
        // $total_num=$number_adult+$number_children+$number_child;
        // $arr['number_per']=$total_num;
>>>>>>> c4e11d6e55a799e78b92f56159587753190945f3
        echo json_encode($arr);
        
    }
}