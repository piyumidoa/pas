<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
	}

	public function index()
	{

			$data['page_title'] = "ආයතන අංශය";
			$authlevel = $this->session->userdata('authlevel'); 
			$data['authlevel'] = $authlevel;
			$this->load->view('common/header', $data);
			$this->load->view('home', $data);
		
	}
}
