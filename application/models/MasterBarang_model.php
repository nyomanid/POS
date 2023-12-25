<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterBarang_model extends CI_Model
{
	
	//master_barang
	public function select($order='asc')
	{
		$this->db->select('*')
		->from('master_barang')
		->join('master_barang_kategori', 'master_barang.id_kategori = master_barang_kategori.id_kategori', 'left')
		->order_by('master_barang.kode_barang', $order);

		return $this->db->get()->result();
	}
	public function insert($data)
	{
		$this->db->insert('master_barang', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	public function update($id, $data)
	{
		$this->db->where('kode_barang', $id)->update('master_barang', $data);
	}
	public function delete($id)
	{
		$this->db->where('kode_barang', $id)->delete('master_barang');
	}

	//master_barang_kategori
	public function select_kategori()
	{
		$this->db->select('*')->from('master_barang_kategori');
		return $this->db->get()->result();
	}
	public function insert_kategori($data)
	{
		$this->db->insert('master_barang_kategori', $data);
	}
	public function update_kategori($id, $data)
	{
		$this->db->where('id_kategori', $id)->update('master_barang_kategori', $data);
	}
	public function delete_kategori($id)
	{
		$this->db->where('id_kategori', $id)->delete('master_barang_kategori');
	}
	public function relasi_kategori($id) {
		$this->db->select('kode_barang')->from('master_barang')->where('id_kategori',$id);
		return $this->db->get()->result();
	}

}

/* End of file MasterBarang_model.php */
