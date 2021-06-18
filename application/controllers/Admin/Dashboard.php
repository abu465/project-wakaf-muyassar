<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 if ( $this->session->role_id != 1) {
         redirect('auth');
     }
	}
	public function index()
	{
		$data['judul'] = "Dashboard";
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/dashboard', $data);
	}
}
