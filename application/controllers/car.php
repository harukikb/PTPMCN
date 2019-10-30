<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car extends CI_Controller {
    var $data = array();
    public function __construct(){
        parent::__construct();  
        
    } 

	public function index()
	{
        $this -> data['title'] = "Booking Car";  
        $this -> data['slide'] = "default/car/slide"; 
        $this -> data['temp'] = "default/car/car";
        
        $this->load->view("default/template",$this ->data);
    }

    public function detail()
    {
        $this -> data['title'] = "Booking Car";
        $this -> data['temp'] = "default/car/car-detail";
        $this->load->view("default/template",$this ->data);
    }

    
    
    public function get_list_hotel_destination(){
        $this->load->model("cars_model");
        echo json_encode($this->cars_model->get_list_hotel_destination());
    }

}
