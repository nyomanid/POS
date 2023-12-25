<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Promo_model');
		if(!$this->session->userdata('nama_admin')){
			redirect('auth/login','refresh');
		}
	}

	//promo
	public function index()
	{
		$data = array(
			'promo' => $this->Promo_model->select()
		);
		$this->load->view('Admin/Promo', $data);
	}
	public function create()
	{
		
		// create unique kode-promo
		// format : promo-xxx, dimana xxx adalah 3 digit angka muali dari 001 - 999
		// ini perlu disesuaikan bisnis prosesnya, karena setelah 999, format akan menjadi 4 digit (promo-xxxx)
		$kode = $this->Promo_model->get_last();
		if($kode == NULL || $kode == null) {
			$kode_angka = 1;
		} else {
			$kode_split = explode("-",$kode->kode_promo);
			$kode_angka = (int) $kode_split[1] + 1;
		}
		if(strlen($kode_angka) < 3) {
			$kode_angka = sprintf("%03d", $kode_angka);
		}
		$kode_final = "promo-".$kode_angka;

		$data = array(
			'kode_promo' => $kode_final,
			'nama_promo' => $this->input->post('nama_promo'),
			'promo' => $this->input->post('promo'),
			'keterangan' => $this->input->post('keterangan')
		);
		$this->Promo_model->insert($data);

		$this->session->set_flashdata('response', ['success','Data Promo Berhasil Disimpan!']);
		redirect('admin/promo');
	}
	public function update($id)
	{
		$data = array(
			'nama_promo' => $this->input->post('nama_promo'),
			'promo' => $this->input->post('promo'),
			'keterangan' => $this->input->post('keterangan')
		);
		$this->Promo_model->update($id, $data);
		$this->session->set_flashdata('response', ['success','Data Promo Berhasil Update!']);
		redirect('admin/promo');
	}
	public function delete($id)
	{
		$this->Promo_model->delete($id);
		$this->session->set_flashdata('response', ['success','Data Promo Berhasil Dihapus!']);
		redirect('admin/promo');
	}


}

/* End of file Promo.php */
