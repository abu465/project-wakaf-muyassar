<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataprogram extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		 $this->load->library('form_validation');
      if ( $this->session->role_id != 1) {
         redirect('auth');
     }
		
	}
	public function index()
	{
		$data['judul'] = "Data Program";
		$data['program'] = $this->db->query("SELECT * FROM tb_program")->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/data_program', $data);
	}
	public function add_program()
	{
		$data['judul'] = "Add Program";
		$data['kategori'] = $this->db->query("SELECT * FROM tb_kt_program WHERE is_published=1")->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/add/add_program', $data);
	}
	public function insert()
	{
		$this->form_validation->set_rules('nama_program','Nama Program','required');
		$this->form_validation->set_rules('wilayah','Wilayah','required');
		$this->form_validation->set_rules('jumlah_penggalangan','Jumlah','required');
		$this->form_validation->set_rules('waktu_penggalangan','Waktu','required');
		$gambar = $_FILES['gambar']['name'];
		if ($gambar = '')
		{

		}else{
			$config['upload_path']		='./uploads';
			$config['allowed_types']	='jpg|jpeg|png|gif';
			$config['encrypt_name']		= true;
			$this->load->library('upload');
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('gambar')){
				echo "upload gagal";
				// $data['judul'] = "404";
				// $this->load->view('template/header',$data);
				// $this->load->view('template/sidebar');
				// $this->load->view('template/topbar',$data);
				// $this->load->view('admin/error',$data);
				// $this->load->view('template/footer'); 

			}else{
				$uploadData = $this->upload->data();
				$file_size  = $uploadData['file_size'];
				$path_source = $uploadData['full_path'];

				$config['image_library']  = 'gd2';
				$config['source_image']   = $path_source;
				$config['quality']        = '100';
				$config['maintain_ratio'] = true;
				// $config['width']     = 75;
				// $config['height']   = 50;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$gambar=$this->upload->data('file_name');        
			}
		}
		if ($this->form_validation->run() == false ){

			$data['judul'] = "Add Program";
			$data['kategori'] = $this->db->query("SELECT * FROM tb_kt_program WHERE is_published=1")->result();
			$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
			$this->template->admin_render('admin/add/add_program', $data);
		}else{
			$data = [
				'nama_program' =>htmlspecialchars($this->input->post('nama_program', true)),
				'penulis' =>htmlspecialchars($this->input->post('penulis', true)),
				'wilayah' =>htmlspecialchars($this->input->post('wilayah', true)),
				'kategori' =>htmlspecialchars($this->input->post('kategori', true)),
				'jumlah_penggalangan' =>htmlspecialchars($this->input->post('jumlah_penggalangan', true)),
				'is_published' =>$this->input->post('is_published'),
				'waktu_penggalangan' =>htmlspecialchars($this->input->post('waktu_penggalangan', true)),
				'detail' =>htmlspecialchars($this->input->post('detail', true)),
				'update' =>htmlspecialchars($this->input->post('update', true)),
				'gambar' => $gambar,
				'date_created' => date("Y-m-d H:i:s")

			];

			$this->db->insert('tb_program', $data);
			$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil di Tambah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				');
			redirect('admin/dataprogram');
		}

	}
	public function detail($id)
	{
		 $data['judul'] = "Detail Program";
		 $data['a'] =$this->db->get_where('tb_program', ['id' => $id])->result();
  		 $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
  		 $this->template->admin_render('admin/detail/detail_program', $data);
  		
	}
	public function edit_data($id)
	{
		$data['judul'] = "Edit Program";
		$data['kategori'] = $this->db->query("SELECT * FROM tb_kt_program WHERE is_published=1")->result();
		$data['a'] =$this->db->get_where('tb_program', ['id' => $id])->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/edit/edit_program', $data);

	}
	public function update()
	{
		$id = $this ->input->post('id');     
		if($_FILES['gambar']['name']!="")
		{
			$config['upload_path']   = './uploads/';
			$config['allowed_types'] ='gif|jpg|png|jpeg|jpe';
			$config['encrypt_name']		= true;
			$this->load->library('upload');
			$this->upload->initialize($config);
			if($this->upload->do_upload('gambar')){
				$uploadData = $this->upload->data();
				$file_size  = $uploadData['file_size'];
				$path_source = $uploadData['full_path'];

				$config['image_library']  = 'gd2';
				$config['source_image']   = $path_source;
				$config['quality']        = '100';
				$config['maintain_ratio'] = true;
				// $config['width']     = 75;
				// $config['height']   = 50;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$gambar = $uploadData['file_name'];
			}else{
				$gambar= '';
			}
		}else{
			$gambar = '';
		}

    //   array


		$nama_program			= $this->input->post('nama_program');
		$penulis				= $this->input->post('penulis');
		$Wilayah 				= $this->input->post('wilayah');
		$jumlah_penggalangan	= $this->input->post('jumlah_penggalangan');
		$waktu_penggalangan		= $this->input->post('waktu_penggalangan');
		$detail 				= $this->input->post('detail');
		$is_published			= $this->input->post('is_published');
		$update 				= $this->input->post('update');
		$kategori 				= $this->input->post('kategori');



    // End

		$data = array(

			'nama_program' 			=> $nama_program,
			'penulis'      			=> $penulis,
			'wilayah' 				=> $wilayah,
			'jumlah_penggalangan' 	=> $jumlah_penggalangan,
			'waktu_penggalangan' 	=> $waktu_penggalangan,
			'detail' 				=> $detail,
			'update' 				=> $update,
			'is_published' 			=> $is_published,
			'kategori' 				=> $kategori
			);




		if($gambar != ''){
			$data['gambar'] = $gambar;
			$row = $this->db->get_where('tb_program',['id' => $id])->row();
			unlink("./uploads/".$row->gambar);
		}

		

		$this->db->where('id',$id);
		$this->db->update('tb_program', $data);
		$this->session->set_flashdata('message', '
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Data Berhasil di Update!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			');
		redirect('admin/dataprogram');
	}
	public function hapus_data($id)
	{
		$_id 	= $this->db->get_where('tb_program',['id' => $id])->row();
		$query 	= $this->db->delete('tb_program',['id'=>$id]);
		if($query){
			unlink("./uploads/".$_id->gambar);

			$this->session->set_flashdata('message', '

				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data Berhasil di Hapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>

				');
		}
		redirect('admin/dataprogram');
	}

	// kategori
	public function kategori_program()
	{
		 $data['judul'] = "Kategori Program";
		 $data['kategori'] = $this->db->query("SELECT * FROM tb_kt_program")->result();
  		 $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		 $this->template->admin_render('admin/kategori/kategori_program', $data);
	}
	public function add_kategori_program()
	{
		$data['judul'] = "Add kategori Program";
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/add/add_kategori_program', $data);
	}
	public function edit_kategori_program($id)
	{
		$data['judul'] = "Edit Kategori Program";
		$data['a'] =$this->db->get_where('tb_kt_program', ['id' => $id])->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/edit/edit_kategori_program', $data);
	}
	public function insert_kategori_program()
	{
		$this->form_validation->set_rules('nama_kategori','Nama Kategori','required');
		if ($this->form_validation->run() == false ){
			$data['judul'] = "Add kategori Program";
			$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
			$this->template->admin_render('admin/add/add_kategori_program', $data);
		}else{
			$data = [
				'nama_kategori' =>htmlspecialchars($this->input->post('nama_kategori', true)),
				'is_published' =>$this->input->post('is_published', true),
				'date_created' => date('Y-m-d H:i:s')

			];

			$this->db->insert('tb_kt_program', $data);
			$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Kategori Berhasil di Tambah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				');
			redirect('admin/dataprogram/kategori_program');
		}
	}
	public function update_kategori_program()
	{
		$id = $this ->input->post('id');     

    //   array


		$nama_kategori= $this->input->post('nama_kategori');
		$is_published= $this->input->post('is_published');

    // End

		$data = array(

			'nama_kategori' => $nama_kategori,
			'is_published' => $is_published);

		$this->db->where('id',$id);
		$this->db->update('tb_kt_program', $data);
		$this->session->set_flashdata('message', '
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Kategori Berhasil di Perbarui!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			');
		redirect('admin/dataprogram/kategori_program');

	}
	public function hapus_kategori_program($id)
	{
		$_id = $this->db->get_where('tb_kt_program',['id' => $id])->row();
		$query = $this->db->delete('tb_kt_program',['id'=>$id]);
		$this->session->set_flashdata('message', '

			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Data Berhasil di Hapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>

			');
		redirect('admin/dataprogram/kategori_program');
	}

}