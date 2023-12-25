<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MasterBarang_model');
		if(!$this->session->userdata('nama_admin')){
			redirect('auth/login','refresh');
		}
	}

	//barang
	public function index()
	{
		$data = array(
			'barang' => $this->MasterBarang_model->select('desc'),
			'kategori' => $this->MasterBarang_model->select_kategori()
		);
		$this->load->view('Admin/Barang', $data);
	}
	public function create()
	{
		$data = array(
			'id_kategori' => $this->input->post('kategori'),
			'nama_barang' => $this->input->post('nama_barang'),
			'deskripsi' => $this->input->post('deskripsi'),
			'harga' => $this->input->post('harga'),
		);
		$kode_barang = $this->MasterBarang_model->insert($data);



		$this->session->set_flashdata('response', ['success','Data Barang Berhasil Disimpan!']);
		redirect('admin/barang/index');
	}
	public function update($id)
	{
		$data = array(
			'id_kategori' => $this->input->post('kategori'),
			'nama_barang' => $this->input->post('nama_barang'),
			'deskripsi' => $this->input->post('deskripsi'),
			'harga' => $this->input->post('harga')
		);
		$this->MasterBarang_model->update($id, $data);
		$this->session->set_flashdata('response', ['success','Data Barang Berhasil Update!']);
		redirect('admin/barang/index');
	}
	public function delete($id)
	{
		$this->MasterBarang_model->delete($id);
		$this->session->set_flashdata('response', ['success','Data Barang Berhasil Dihapus!']);
		redirect('admin/barang/index');
	}

	//kategori
	public function kategori()
	{
		$data = array(
			'kategori' => $this->MasterBarang_model->select_kategori()
		);
		$this->load->view('Admin/BarangKategori', $data);
	}
	public function create_kategori()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama')
		);
		$this->MasterBarang_model->insert_kategori($data);
		$this->session->set_flashdata('response', ['success','Data Kategori Berhasil Disimpan!']);
		redirect('admin/barang/kategori');
	}
	public function update_kategori($id)
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama')
		);
		$this->MasterBarang_model->update_kategori($id, $data);
		$this->session->set_flashdata('response', ['success','Data Kategori Berhasil Update!']);
		redirect('admin/barang/kategori');
	}
	public function delete_kategori($id)
	{
		// cek relasinya dengan barang dulu
		if(count($this->MasterBarang_model->relasi_kategori($id)) == 0) {
			$this->MasterBarang_model->delete_kategori($id);
			$this->session->set_flashdata('response', ['success','Data Kategori Berhasil Dihapus!']);
		} else {
			$this->session->set_flashdata('response', ['danger','Data Kategori Masih digunakan pada Data Barang. Data Kategori Gagal Dihapus!']);
		}
		redirect('admin/barang/kategori');
	}
}

/* End of file Barang.php */
