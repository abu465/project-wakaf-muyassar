<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		
	}
	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == false){
			$data['judul'] = "Login";
		$this->template->auth_render('auth/login', $data);

			
		}else{
			$this->_login();
		}
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user',['email' => $email])->row_array();
		//jika user nya ada
		if($user){
			// usernya aktif
			if($user['is_active'] == 1){
				// cek password
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if($user['role_id'] == 1){
						redirect('admin/dashboard');
					} else {
						// redirect('');
						echo "role 2";
					}
					
				}else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Kata Sandi Salah !
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
			redirect('auth');
				}
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
						Email Anda telah diaktifkan !
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
			redirect('auth');
			}

		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						Email Anda tidak terdaftar !
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
			redirect('auth');
		}
	}
	public function regristrasi()
	{
		
		$this->form_validation->set_rules('nama_lengkap', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'This Email has already registred! '
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]',[
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('no_tlpn', 'NoTlp', 'required|trim');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		$this->form_validation->set_rules('agree', 'Setuju','required');
		if ($this->form_validation->run() == false ) {
		$data['judul'] = "Daftar";
		$this->template->auth_render('auth/regristrasi', $data);
		}else {
			$data = [
				'nama_lengkap' =>htmlspecialchars($this->input->post('nama_lengkap', true)),
				'email' =>htmlspecialchars($this->input->post('email', true)),
				'no_tlpn' =>htmlspecialchars($this->input->post('no_tlpn', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 1,
				'is_active' => 1,
				'gambar'    => 'avatar-1.png',
				'date_created' => date('Y-m-d H:i:s')
				
			];
			

			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						Akun Anda telah dibuat silahkan login!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
			redirect('auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
						Anda Telah Logout!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
						</div>');
			redirect('auth');

	}


}
