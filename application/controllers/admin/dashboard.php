<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Dashboard extends CI_Controller {



	public function __construct(){
        parent::__construct();
    } 

   function index()

   {
        $data['temp'] = "admin/dashboard";
        $data['title'] = "Quản lý";
        $this->load->view("admin/template",$data);
   }

}