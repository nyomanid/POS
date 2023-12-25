<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo_model extends CI_Model
{

	public function select()
	{
		$this->db->select('*')->from('promo');
		return $this->db->get()->result();
	}
	public function get($id)
	{
		$this->db->select('*')->from('promo')->where('kode_promo',$id);
		return $this->db->get()->row();
	}
	
	public function get_last()
	{
		$this->db->select('kode_promo')->from('promo')->order_by('kode_promo','desc')->limit(1);
		return $this->db->get()->row();
	}
	public function insert($data)
	{
		$this->db->insert('promo', $data);
	}
	public function update($id, $data)
	{
		$this->db->where('kode_promo', $id)->update('promo', $data);
	}
	public function delete($id)
	{
		$this->db->where('kode_promo', $id)->delete('promo');
	}

}

/* End of file Promo_model.php */
