<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
    var $data = array();
    public function __construct(){
        parent::__construct();  
        $this -> data['title'] = "Booking Tour";
        $this -> data['temp'] = "default/home"; 
    } 

	public function index()
	{
        $this -> data['custom_css'] = array(
        "assets/default/rev-slider-files/fonts/font-awesome/css/font-awesome.css",
        "assets/default/rev-slider-files/css/settings.css"
        );
        $this -> data['custom_js'] = array(
            "assets/default/rev-slider-files/js/extensions/revolution.extension.video.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.slideanims.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.parallax.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.navigation.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.migration.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.layeranimation.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.kenburn.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.carousel.min.js",
            "assets/default/rev-slider-files/js/extensions/revolution.extension.actions.min.js",
            "assets/default/rev-slider-files/js/jquery.themepunch.revolution.min.js",
            "assets/default/rev-slider-files/js/jquery.themepunch.tools.min.js",
            "assets/default/js/home.js",
            "assets/default/js/notify_func.js");
        $this->load->view("default/template",$this ->data);
    }
    public function get_list_tours(){
        $this->load->model("home_model");
        $arr=$this->home_model->getListTour();
        //đếm số lượng ds bài post lấy đc
        $arr['total_record']=count($arr);
        echo json_encode($arr);
    }
    
}
