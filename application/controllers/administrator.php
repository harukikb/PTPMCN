<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function index()
	{
        if($this->session->userdata('loggedAdmin') == TRUE)
            $this->load->view('admin/admin_login');
        else 
            redirect('admin/dashboard');
	}
}
