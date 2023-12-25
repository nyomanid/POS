<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PenjualanHeader_model');
		$this->load->model('MasterBarang_model');
		$this->load->model('Promo_model');
		if(!$this->session->userdata('nama_admin')){
			redirect('auth/login','refresh');
		}
	}
	public function index()
	{
		$data = array(
			'penjualan' => $this->PenjualanHeader_model->select(),
			'barang' => $this->MasterBarang_model->select(),
			'promo' => $this->Promo_model->select()
		);
		$this->load->view('Admin/Penjualan', $data);
	}
	
	public function detail($id)
	{
		$detail = $this->PenjualanHeader_model->detail($id);
		$data = array(
			'detail' => $detail,
			'promo' => $this->Promo_model->get($detail['transaksi']->kode_promo)
		);
		$this->load->view('Admin/PenjualanDetail', $data);
	}
}

/* End of file Penjualan.php */
