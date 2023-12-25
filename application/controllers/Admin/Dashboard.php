<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('nama_admin')){
			redirect('auth/login','refresh');
		}
	}


	public function index()
	{
		$dashboard = $this->dashboard();
		$data = array(
			'jumlah' => $dashboard,
			'transaksi' => $this->transaksi_penjualan(),
			'total_penjualan' => $this->total_penjualan()
		);
		
		$this->load->view('Admin/Dashboard', $data);
		
	}
	public function dashboard() {
		
		$data['master_barang'] = $this->db->query("SELECT COUNT(kode_barang) as jumlah FROM master_barang")->row();
		$data['user_admin'] = $this->db->query("SELECT COUNT(id_user) as jumlah FROM `user_admin`;")->row();
		return $data;
	}
	public function transaksi_penjualan() {
		$this->db->select('*')
			->from('penjualan_header');
		return $this->db->get()->result();
	}
	public function total_penjualan() {
		//$this->db->query("SELECT SUM(grand_total) as total, tgl_transaksi FROM `penjualan_header`")->result();
		$data = $this->db
			->select_sum('grand_total')
			->from('penjualan_header')
			->get();
		return $data->result_array();
	}
	
}

/* End of file Dashboard.php */
