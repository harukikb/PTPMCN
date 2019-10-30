<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel extends CI_Controller {

    public function __construct(){
        parent::__construct();         
    } 

function index()
   {
        $data['temp'] = "admin/hotel/hotel";
        $data['title'] = "Quản lý hotel";
        $this->load->model('hotel_model');
        $data['list_hotel']=$this->hotels_model->getList();
        $this->load->view("admin/template",$data);
   }
}