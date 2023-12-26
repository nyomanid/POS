<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanTransaksi extends CI_Controller
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
			'barang' => $this->MasterBarang_model->select(),
			'promo' => $this->Promo_model->select()
		);
		$this->load->view('Admin/PenjualanTransaksi', $data);
	}

	public function addtocart()
	{
		$subtotal = ($this->input->post('pos_harga_barang') * $this->input->post('pos_qty'));
		if($this->input->post('pos_value_promo') == "") {
			$show_promo = "-";
			$show_subtotal = $subtotal * 1;
		} else {
			$show_promo = $this->input->post('pos_value_promo')."%";
			$show_subtotal = $subtotal - ($subtotal * $this->input->post('pos_value_promo') / 100);
		}

		$data = array(
			'id'      => $this->input->post('pos_barang'),
			'qty'     => $this->input->post('pos_qty'),
			'price'   => $show_subtotal / $this->input->post('pos_qty'),
			'name'    => $this->input->post('pos_nama_barang'),
			'options' => array('pos_customer' => $this->input->post('pos_customer'), 'pos_harga_barang' => $this->input->post('pos_harga_barang'), 'pos_promo' => $this->input->post('pos_promo'), 'pos_value_promo' => $this->input->post('pos_value_promo'), 'show_promo' => $show_promo, 'show_subtotal' => $show_subtotal)
		);
		$this->cart->insert($data);
		$this->session->set_flashdata('response', ['success','Transaksi Penjualan Berhasil Ditambahkan ke Keranjang!']);
		redirect('admin/penjualantransaksi', 'refresh');
	}
	public function deletecart($id)
	{
		$this->cart->remove($id);
		redirect('admin/penjualantransaksi', 'refresh');
	}
	public function checkout()
	{


		// create unique no-transaksi
		// format : Ym-xxx, dimana xxx adalah 3 digit angka mulai dari 001 - 999
		// ini perlu disesuaikan bisnis prosesnya, karena setelah 999, format akan menjadi 4 digit (Ym-xxxx)
		$no_trx = $this->PenjualanHeader_model->get_last();

		if($no_trx == NULL || $no_trx == null) {
			$no_trx_angka = 1;
		} else {
			$no_trx_split = explode("-",$no_trx->no_transaksi);
			$no_trx_angka = (int) $no_trx_split[1] + 1;
		}
		if(strlen($no_trx_angka) < 3) {
			$no_trx_angka = sprintf("%03d", $no_trx_angka);
		}
		$no_trx_final = date('Ym')."-".$no_trx_angka;

		//data transaksi
		$transaksi = array(
			'no_transaksi' => $no_trx_final,
			'tgl_transaksi' => date('Y-m-d H:i:s'),
			'total_bayar' => $this->cart->total(),
			'grand_total' => $this->cart->total() + ($this->cart->total() * 11 / 100),
			'ppn' => '11'
		);
		$this->db->insert('penjualan_header', $transaksi);

		//data detail transaksi
		foreach ($this->cart->contents() as $key => $value) {
			$data_customer = $value['options']['pos_customer'];
			$data_promo = $value['options']['pos_promo'];
			$detail_transaksi = array(
				'no_transaksi' => $no_trx_final,
				'kode_barang' => $value['id'], // pos_barang
				'qty' => $value['qty'],
				'harga' => $value['options']['pos_harga_barang'],
				'subtotal' => $value['options']['show_subtotal']
			);
			$this->db->insert('penjualan_header_detail', $detail_transaksi);
		}

		// update data transaksi
		$transaksi = array(
			'customer' => $data_customer,
			'kode_promo' => $data_promo
		);
		$this->db->where('no_transaksi', $no_trx_final)->update('penjualan_header', $transaksi);

		$this->cart->destroy();
		$this->session->set_flashdata('response', ['success','Data Transaksi Penjualan Berhasil Disimpan!!!']);
		redirect('admin/penjualan', 'refresh');
	}
}

/* End of file PenjualanTransaksi.php */
