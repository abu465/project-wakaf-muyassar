<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Databerita extends CI_Controller {
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
		$data['judul'] = "Data Berita";
		$data['berita'] = $this->db->query("SELECT * FROM tb_berita")->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/data_berita', $data);
	}
	public function add_berita()
	{
		$data['judul'] = "Add Berita";
		$data['kategori'] = $this->db->query("SELECT * FROM tb_kt_berita WHERE is_published=1")->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/add/add_berita', $data);
	}
	public function insert()
	{
		$this->form_validation->set_rules('judul','Judul Berita','required');
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

			$data['judul'] = "Add Berita";
			$data['kategori'] = $this->db->query("SELECT * FROM tb_kt_berita WHERE is_published=1")->result();
			$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
			$this->template->admin_render('admin/add/add_berita', $data);
		}else{
			$data = [
				'judul' 			=>$this->input->post('judul'),
				'penulis' 			=>$this->input->post('penulis'),
				'kategori' 			=>$this->input->post('kategori'),
				'is_published' 		=>$this->input->post('is_published'),
				'deskripsi' 		=>$this->input->post('deskripsi'),
				'gambar' 			=> $gambar,
				'date_created' 		=> date("Y-m-d H:i:s")

			];

			$this->db->insert('tb_berita', $data);
			$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data Berhasil di Tambah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				');
			redirect('admin/databerita');
		}

	}

	public function detail($id)
	{
		 $data['judul'] = "Detail Berita";
		 $data['a'] =$this->db->get_where('tb_berita', ['id' => $id])->result();
  		 $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
  		 $this->template->admin_render('admin/detail/detail_berita', $data);
  		
	}
		public function edit_data($id)
	{
		$data['judul'] = "Edit Berita";
		$data['kategori'] = $this->db->query("SELECT * FROM tb_kt_berita WHERE is_published=1")->result();
		$data['a'] =$this->db->get_where('tb_berita', ['id' => $id])->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/edit/edit_berita', $data);

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


		$judul					= $this->input->post('judul');
		$penulis				= $this->input->post('penulis');
		$deskripsi 				= $this->input->post('deskripsi');
		$is_published			= $this->input->post('is_published');
		$kategori 				= $this->input->post('kategori');



    // End

		$data = array(

			'judul' 				=> $judul,
			'penulis'      			=> $penulis,
			'deskripsi' 			=> $deskripsi,
			'is_published' 			=> $is_published,
			'kategori' 				=> $kategori
		);




		if($gambar != ''){
			$data['gambar'] = $gambar;
			$row = $this->db->get_where('tb_berita',['id' => $id])->row();
			unlink("./uploads/".$row->gambar);
		}

		

		$this->db->where('id',$id);
		$this->db->update('tb_berita', $data);
		$this->session->set_flashdata('message', '
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Data Berhasil di Update!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			');
		redirect('admin/databerita');
	}
	public function hapus_data($id)
	{
		$_id 	= $this->db->get_where('tb_berita',['id' => $id])->row();
		$query 	= $this->db->delete('tb_berita',['id'=>$id]);
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
		redirect('admin/databerita');
	}



	// Kategori
	public function kategori_berita()
	{
		$data['judul'] = "Kategori Berita";
		 $data['kategori'] = $this->db->query("SELECT * FROM tb_kt_berita")->result();
  		 $data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		 $this->template->admin_render('admin/kategori/kategori_berita', $data);
	}
	public function add_kategori_berita()
	{
		$data['judul'] = "Add kategori Berita";
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/add/add_kategori_berita', $data);
	}
	public function edit_kategori_berita($id)
	{
		$data['judul'] = "Edit Kategori Berita";
		$data['a'] =$this->db->get_where('tb_kt_berita', ['id' => $id])->result();
		$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
		$this->template->admin_render('admin/edit/edit_kategori_berita', $data);
	}
	public function insert_kategori_berita()
	{
		$this->form_validation->set_rules('nama_kategori','Nama Kategori','required');
		if ($this->form_validation->run() == false ){
			$data['judul'] = "Add kategori Berita";
			$data['user'] = $this->db->get_where('user', ['email'=> $this->session->userdata('email')])->row_array();
			$this->template->admin_render('admin/add/add_kategori_berita', $data);
		}else{
			$data = [
				'nama_kategori' =>htmlspecialchars($this->input->post('nama_kategori', true)),
				'is_published' =>$this->input->post('is_published', true),
				'date_created' => date('Y-m-d H:i:s')

			];

			$this->db->insert('tb_kt_berita', $data);
			$this->session->set_flashdata('message', '
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Kategori Berhasil di Tambah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				');
			redirect('admin/databerita/kategori_berita');
		}
	}
		public function update_kategori_berita()
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
		$this->db->update('tb_kt_berita', $data);
		$this->session->set_flashdata('message', '
			<div class="alert alert-info alert-dismissible fade show" role="alert">
			<strong>Kategori Berhasil di Perbarui!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			');
		redirect('admin/databerita/kategori_berita');

	}
	public function hapus_kategori_berita($id)
	{
		$_id = $this->db->get_where('tb_kt_berita',['id' => $id])->row();
		$query = $this->db->delete('tb_kt_berita',['id'=>$id]);
		$this->session->set_flashdata('message', '

			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>Data Berhasil di Hapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>

			');
		redirect('admin/databerita/kategori_berita');
	}

}
