<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanHeader_model extends CI_Model
{

	//admin
	public function select()
	{
		$this->db->select('*')
		->from('penjualan_header')->order_by('no_transaksi','desc');
		return $this->db->get()->result();
	}
	public function detail($no_transaksi)
	{
		$data['transaksi'] = $this->db->query("SELECT * FROM `penjualan_header` WHERE penjualan_header.no_transaksi='" . $no_transaksi . "'")->row();
		$data['transaksi_detail'] = $this->db->query("SELECT * FROM `penjualan_header` JOIN penjualan_header_detail ON penjualan_header.no_transaksi = penjualan_header_detail.no_transaksi JOIN master_barang ON master_barang.kode_barang = penjualan_header_detail.kode_barang  WHERE penjualan_header_detail.no_transaksi='" . $no_transaksi . "'")->result();
		return $data;
	}
	public function get_last()
	{
		$tahun_bulan = date("Ym");
		$this->db->select('no_transaksi')
		->from('penjualan_header')
		->like('no_transaksi',$tahun_bulan)
		->order_by('no_transaksi','desc')->limit(1);
		return $this->db->get()->row();
	}

	
}

/* End of file PenjualanHeader_model.php */
