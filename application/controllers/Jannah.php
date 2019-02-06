<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jannah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')!=TRUE) {
			redirect('admin/login','refresh');
		}
		$this->load->model('m_jannah','jannah');
	}

	public function index()
	{
		$data['tampil_jannah']=$this->jannah->tampil();
		$data['kategori']=$this->jannah->data_kategori();
		$data['konten']="v_jannah";
		$data['judul']="Daftar jannah";
		$this->load->view('template', $data);
	}
	public function toko()
	{
		$data['tampil_jannah']=$this->jannah->tampil();
		$data['kategori']=$this->jannah->data_kategori();
		$data['konten']="toko";
		$data['judul']="Jannah Store";
		$this->load->view('template', $data);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('merk_jannah', 'merk_jannah', 'trim|required');
		$this->form_validation->set_rules('size', 'size', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		if ($this->form_validation->run()==TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1000';
			$config['max_width']  = '5000';
			$config['max_height']  = '5000';
			if ($_FILES['foto']['name']!="") {
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('foto')) {
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
				}else {
					if ($this->jannah->simpan_jannah($this->upload->data('file_name'))) {
						$this->session->set_flashdata('pesan', 'Sukses menambah ');
					}else{
						$this->session->set_flashdata('pesan', 'Gagal menambah');
					}
					redirect('jannah','refresh');
				}
			}else{
				if ($this->jannah->simpan_jannah('')) {
					$this->session->set_flashdata('pesan', 'Sukses menambah');
				}else{
					$this->session->set_flashdata('pesan', 'Gagal menambah');
				}
				redirect('jannah','refresh');
			}
			
		}else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('jannah','refresh');
		}
	}
	public function edit_jannah($id)
	{
		$data=$this->jannah->detail($id);
		echo json_encode($data);
	}
	public function jannah_update()
	{
		if($this->input->post('edit')){
			if($_FILES['foto']['name']==""){
				if($this->jannah->edit_jannah()){
					$this->session->set_flashdata('pesan', 'Sukses update');
					redirect('jannah');
				} else {
					$this->session->set_flashdata('pesan', 'Gagal update');
					redirect('jannah');
				}
			} else {
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '20000';
				$config['max_width']  = '5024';
				$config['max_height']  = '5768';
				
				$this->load->library('upload', $config);
				
				if ( ! $this->upload->do_upload('foto')){
					$this->session->set_flashdata('pesan', 'Gagal Upload');
					redirect('jannah');
				}
				else{
					if($this->jannah->edit_jannah_dengan_foto($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'Sukses update');
						redirect('jannah');
					} else {
						$this->session->set_flashdata('pesan', 'Gagal update');
						redirect('jannah');
					}
				}
			}
			
		}

	}
	public function hapus($id_jannah='')
	{
		if ($this->jannah->hapus_jannah($id_jannah)) {
			$this->session->set_flashdata('pesan', 'Sukses Hapus Buku');
			redirect('jannah','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Gagal Hapus Buku');
			redirect('jannah','refresh');
		}
	}

}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */